<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Category extends Model {

    const IMAGE_PATH = 'category';
    const CATEGORY_FOREIGN_KEY = 'category_id';
    const CATEGORY_TEMP_FILE = 'cate_data.txt';

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
        'cover_image'
    ];

    public function fileInfos()
    {
        return $this->belongsToMany(FilesInfo::class, 'category_files', 'category_id', 'file_id');
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
            self::deleteImage($this->thumbnail);

            self::deleteImage($this->cover_image);
        }

        self::saveCateToFile();

        return $should_delete;
    }

    public static function getList($params = array())
    {
        return Category::paginate(LIMIT_ROW);
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
                    self::IMAGE_PATH,
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

    public function getThumbnail()
    {
        return $this->getImage($this->thumbnail);
    }

    public function getThumbnailUrl()
    {
        return $this->getImage($this->thumbnail, true);
    }

    public function getCoverImage()
    {
        return $this->getImage($this->cover_image);
    }

    public function getCoverImageUrl()
    {
        return $this->getImage($this->cover_image, true);
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

    public static function saveCateToFile()
    {
        Storage::disk('public')->put(self::IMAGE_PATH.'/'.self::CATEGORY_TEMP_FILE, json_encode(self::getList()->items()));
    }

    public static function getCateFile()
    {
        $content = null;
        if (Storage::disk('public')->exists(self::IMAGE_PATH.'/'.self::CATEGORY_TEMP_FILE)) {
            $content = Storage::disk('public')->get(self::IMAGE_PATH.'/'.self::CATEGORY_TEMP_FILE);
        }
        return json_decode($content, true);
    }

    public static function getCatesByIdFiles($fileIds, $params = array())
    {
        $categories = Category::select('category_files.file_id', 'categories.*')->leftJoin('category_files', function($join) use($fileIds){
            $join->on('categories.id', '=', 'category_files.category_id')
            ->whereIn('category_files.file_id', $fileIds);
        })->get();

        $cateNames = array();

        $categories->map(function ($category) use ( & $cateNames) {
            $cateNames[$category->file_id][] = array(
                'id'   => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'status' => $category->status,
            );
        });

        return $cateNames;
    }
}