<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\Category;

class FilesInfo extends Model {

    const THUMBNAIL_PATH = 'files_info';

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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($filesInfo) {
            $relationMethods = [];

            foreach ($relationMethods as $relationMethod) {
                if ($filesInfo->$relationMethod()->count() > 0) {
                    return false;
                }
            }
            self::deleteThumbnail($filesInfo);
            return true;
        });
    }

    public static function getList($params = array())
    {
        /*
        $query = \DB::table('files_info AS t1')
                ->select('t1.*', 't2.name AS categoryName')
                ->leftJoin('categories AS t2', 't2.id', '=', 't1.category_id');

        $result = $query->paginate(LIMIT_ROW);
         * 
         */
        $result = FilesInfo::paginate(LIMIT_ROW);
        return $result;
    }

    public static function uploadThumbnail($request)
    {
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = Storage::disk('public')->putFileAs(
                    self::THUMBNAIL_PATH,
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
}