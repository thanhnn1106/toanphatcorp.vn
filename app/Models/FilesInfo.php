<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\Category;

class FilesInfo extends Model {

    const IMAGE_PATH = 'files_info';

    const CATEGORY_FILES_PATH = self::IMAGE_PATH . '/files';

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
        'cover_image',
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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_files', 'file_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'file_tags', 'file_id', 'tag_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_files_download', 'file_id', 'user_id');
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
            self::deleteImage($this);

            // Delete file and folder in category of files
            self::deleteFolderAndFile($this);

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
        $query = FilesInfo::select('files_info.*')->join('category_files', function ($join) use ($params) {
            $join->on('files_info.id', '=', 'category_files.file_id');
            if (isset($params['category_id'])) {
                $join->where('category_files.category_id', $params['category_id']);
            }
        })
        ->where('status', config('site.file_status.value.active'));
        if (isset($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }
        $query->orderBy('created_at', 'DESC');

        $result = $query->paginate(LIMIT_FRONT_ROW);

        return $result;
    }

    /**
     * Get new file list in home.
     *
     * @param $date
     * @author ngthanh <thanh.nn1106@gmail.com>
     */
    public static function getNewFileFront($date)
    {
        $query = FilesInfo::select('*')
            ->whereDate('created_at', '=', $date)
            ->where('status', config('site.file_status.value.active'))
            ->orderBy('created_at', 'DESC')
            ->get();

        return $query;
    }
    /**
     * Get file list by tag id.
     *
     * @param $tagId
     * @author ngthanh <thanh.nn1106@gmail.com>
     */
    public static function getListFileByTagId($params)
    {
        $query = FilesInfo::select('files_info.*')->join('file_tags', function ($join) use ($params) {
            $join->on('files_info.id', '=', 'file_tags.file_id');
            if (isset($params['tag_id'])) {
                $join->where('file_tags.tag_id', $params['tag_id']);
            }
        })
        ->where('status', config('site.file_status.value.active'));
        if (isset($params['tag_id'])) {
            $query->where('tag_id', $params['tag_id']);
        }
        $query->orderBy('created_at', 'DESC');

        $result = $query->paginate(LIMIT_FRONT_ROW);

        return $result;
    }

    public static function search($params = array())
    {
        $query = FilesInfo::where('status', config('site.file_status.value.active'));

        if (isset($params['keyword'])) {
            $query->where('title', 'LIKE', "%{$params['keyword']}%");
            $query->orWhere('track_list', 'LIKE', "%{$params['keyword']}%");
        }
        $query->orderBy('created_at', 'DESC');

        $result = $query->paginate(LIMIT_FRONT_ROW);

        return $result;
    }

    public static function uploadImage($request, $fieldName = 'thumbnail')
    {
        if ($fieldName !== 'thumbnail' && $fieldName !== 'cover_image') {
            return null;
        }
        $prefix = '-thumb';
        if ($fieldName === 'cover_image') {
            $prefix = '-cover';
        }

        $path = null;
        if ($request->hasFile($fieldName)) {
            $path = Storage::disk('public')->putFileAs(
                    self::IMAGE_PATH . '/images',
                    new File($request->file($fieldName)),
                    time().$prefix.'-'.$request->file($fieldName)->getClientOriginalName()
            );
        }
        return $path;
    }

    public static function deleteImage($imagePath)
    {
        Storage::disk('public')->delete($imagePath);
    }

    public static function makeFolderAndFile($filesInfo)
    {
        if ($filesInfo === NULL) {
            return false;
        }

        Storage::disk('public')->makeDirectory(self::CATEGORY_FILES_PATH.'/'.$filesInfo->id);

        return true;
    }

    public static function deleteFolderAndFile($filesInfo)
    {
        Storage::disk('public')->deleteDirectory(self::CATEGORY_FILES_PATH.'/'.$filesInfo->id);
    }

    public function getThumbnail()
    {
        $imagePath = $this->getImage($this->thumbnail);
        return $this->getDefaultImage($imagePath, false, true);
    }

    public function getThumbnailUrl()
    {
        $imagePath = $this->getImage($this->thumbnail, true);
        return $this->getDefaultImage($imagePath, true, true);
    }

    public function getCoverImage()
    {
        $imagePath = $this->getImage($this->cover_image);
        return $this->getDefaultImage($imagePath, false);
    }

    public function getCoverImageUrl()
    {
        $imagePath = $this->getImage($this->cover_image, true);
        return $this->getDefaultImage($imagePath, true);
    }

    protected function getDefaultImage($imagePath, $isUrl = false, $isThumb = false)
    {
        if (empty($imagePath)) {
            $coverDefault = 'front/images/file_cover_default.jpg';
            $thumbDefault = 'front/images/file_thumb_default.jpg';

            $defaultImage = $coverDefault;
            if ($isThumb) {
                $defaultImage = $thumbDefault;
            }

            if ($isUrl) {
                return asset($defaultImage);
            }
            return basename($defaultImage);
        }

        return $imagePath;
    }

    protected function getImage($imagePath, $isUrl = false)
    {
        if (empty($imagePath)) {
            return null;
        }

        if (Storage::disk('public')->exists($imagePath)) {
            if ($isUrl) {
                return asset(Storage::url($imagePath));
            }
            return basename($imagePath);
        }

        return null;
    }

    public function download()
    {
        $pathFile = self::CATEGORY_FILES_PATH.'/'.$this->id . '/' . $this->file_name;
        if ( ! Storage::disk('public')->exists($pathFile)) {
            return false;
        }

        $file = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$pathFile;

        return response()->download($file);
    }

    public function getTagNames()
    {
        $tagNames = $this->tags()->get()->map(function ($item) {
            return $item->name;
        })->toArray();


        return implode(',', $tagNames);
    }

    function getTitleWithDate()
    {
        return $this->title.' [' . date('d-M-Y') . ']';
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

    public function isPremiumDownload()
    {
        if ($this->type_download == config('site.type_download.value.premium')) {
            return true;
        }
        return false;
    }

    public function isNormalDownload()
    {
        if ($this->type_download == config('site.type_download.value.normal')) {
            return true;
        }
        return false;
    }

    public function isMaxDownload()
    {
        $user  = \Auth::user();
        $count = $this->users()->whereBetween('user_files_download.created_at', [$user->purchase_date, $user->expired_date])->count();

        if ($count < MAX_PREMIUM_FILE_DOWNLOAD) {
            return true;
        }
        return false;
    }
}