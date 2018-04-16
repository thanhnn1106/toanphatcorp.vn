<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Category extends Model {

    const THUMBNAIL_PATH = 'category';
    const CATEGORY_FOREIGN_KEY = 'category_id';

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

    public function fileInfos()
    {
        return $this->hasMany('App\Models\FilesInfo', 'category_id', 'id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function deleteCate()
    {
        $relationships = array('fileInfos');
        $should_delete = true;

        foreach($relationships as $r) {
            if ($this->$r()->count()) {
                $should_delete = false;
                break;
            }
        }
        if ($should_delete == true) {
            $this->delete();

            // Delete thumbnail when delete category
            self::deleteThumbnail($this);
        }

        self::saveCateToFile();

        return $should_delete;
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
                    self::THUMBNAIL_PATH,
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

    public static function saveCateToFile()
    {
        Storage::disk('public')->put(self::THUMBNAIL_PATH . '/cate_data.txt', json_encode(self::getList()->items()));
    }

    public static function getCateFile()
    {
        $content = Storage::disk('public')->get(self::THUMBNAIL_PATH . '/cate_data.txt');
        return json_decode($content, true);
    }
}