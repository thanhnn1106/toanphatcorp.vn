<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\Category;

class FilesInfo extends Model {

    const THUMBNAIL_PATH = 'files_info';

    const CATEGORY_FILES_PATH = self::THUMBNAIL_PATH . '/categories';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        Category::CATEGORY_FOREIGN_KEY,
        'title',
        'slug',
        'track_list',
        'type_download',
        'status',
        'thumbnail',
        'file_name',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'file_tags', 'file_id', 'tag_id');
    }

    public function deleteFiles()
    {
        $relationships = array();
        $should_delete = true;

        foreach($relationships as $r) {
            if ($this->$r()->count()) {
                $should_delete = false;
                break;
            }
        }
        if ($should_delete == true) {

            // Delete thumbnail when delete category
            self::deleteThumbnail($this);

            // Delete file and folder in category of files
            self::deleteCateFolderAndFile($this->category->name);

            $this->delete();
        }

        return $should_delete;
    }

    public static function getList($params = array())
    {
        $result = FilesInfo::paginate(LIMIT_ROW);
        return $result;
    }

    public static function getListFront($params = array())
    {
        $query = FilesInfo::where('status', config('site.file_status.value.active'))->orderBy('created_at', 'DESC');

        $result = $query->paginate(LIMIT_FRONT_ROW);
        return $result;
    }

    public static function uploadThumbnail($request)
    {
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = Storage::disk('public')->putFileAs(
                    self::THUMBNAIL_PATH . '/thumb',
                    new File($request->file('thumbnail')),
                    time().'-'.$request->file('thumbnail')->getClientOriginalName()
            );
        }
        return $path;
    }

    public static function deleteThumbnail($filesInfo)
    {
        Storage::disk('public')->delete($filesInfo->thumbnail);
    }

    public static function makeCateFolderAndFile($filesInfo, $oldCateName = '', $type = 'edit')
    {
        if ($filesInfo === NULL) {
            return false;
        }

        $newCateName = null;
        $cate = Category::find($filesInfo->category_id);
        if ($cate !== NULL) {
            $newCateName = $cate->name;
        }

        if ($type === 'add') {

            Storage::disk('public')->makeDirectory(self::CATEGORY_FILES_PATH.'/'.$newCateName);

        } else {

            $files = Storage::disk('public')->allFiles(self::CATEGORY_FILES_PATH.'/'.$oldCateName);

            // Move from old to new
            if ( ! empty($files) && $oldCateName !== $newCateName) {
                foreach ($files as $file) {
                    Storage::disk('public')->move($file, self::CATEGORY_FILES_PATH.'/'.$newCateName . '/'.basename($file));
                }
                // Delete old category
                self::deleteCateFolderAndFile($oldCateName);
            }
        }
        return true;
    }

    public static function deleteCateFolderAndFile($cateName)
    {
        Storage::disk('public')->deleteDirectory(self::CATEGORY_FILES_PATH.'/'.$cateName);
    }

    public function getThumbnail()
    {
        if (empty($this->thumbnail)) {
            return null;
        }

        if (Storage::disk('public')->exists($this->thumbnail)) {
            return basename($this->thumbnail);
        }

        return null;
    }

    public function getThumbnailUrl()
    {
        if (empty($this->thumbnail)) {
            return null;
        }

        if (Storage::disk('public')->exists($this->thumbnail)) {
            return asset(Storage::url($this->thumbnail));
        }

        return null;
    }

    public function getTagNames()
    {
        $tagNames = $this->tags()->get()->map(function ($item) {
            return $item->name;
        })->toArray();


        return implode(',', $tagNames);
    }

    public function getStatusLabel()
    {
        $const = config('site.file_status.label');
        if (isset($const[$this->status])) {
            return $const[$this->status];
        }
        return null;
    }

    public function getTypeDownloadLabel()
    {
        $const = config('site.type_download.label');
        if (isset($const[$this->type_download])) {
            return $const[$this->type_download];
        }
        return null;
    }

    public function isDownload()
    {
        if ($this->type_download == config('site.type_download.value.premium')) {
            return true;
        }
        return false;
    }
}