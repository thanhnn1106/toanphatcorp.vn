<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Category extends Model {

    const THUMBNAIL_PATH = 'category';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($category) {
            $relationMethods = [];

            foreach ($relationMethods as $relationMethod) {
                if ($category->$relationMethod()->count() > 0) {
                    return false;
                }
            }
            self::deleteThumbnail($category);
            return true;
        });
    }

    public static function getList($params = array())
    {
        return Category::paginate(LIMIT_ROW);
    }

    public static function uploadThumbnail($request)
    {
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = Storage::disk('public')->putFileAs(
                    'category',
                    new File($request->file('thumbnail')),
                    time().'-'.$request->file('thumbnail')->getClientOriginalName()
            );
        }
        return $path;
    }

    public static function deleteThumbnail($category)
    {
        Storage::disk('public')->delete($category->thumbnail);
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
}