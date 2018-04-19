<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model {

    const TAGS_FOREIGN_KEY = 'tag_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function files()
    {
        return $this->belongsToMany(FilesInfo::class, 'file_tags', 'tag_id', 'file_id');
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

    public static function getList($params = array())
    {
        return Category::paginate(LIMIT_ROW);
    }

    public static function getTagsByIdFiles($fileIds)
    {
        $tags = Tags::select('file_tags.file_id', 'tags.*')->join('file_tags', function($join) use($fileIds){
            $join->on('tags.id', '=', 'file_tags.tag_id')
            ->whereIn('file_tags.file_id', $fileIds);
        })->get();

        return $tags;
    }
}