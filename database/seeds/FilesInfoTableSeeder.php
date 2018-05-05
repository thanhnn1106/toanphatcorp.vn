<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tags;
use App\Models\FilesInfo;

class FilesInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filesInfo = array();
        for ($i = 0; $i <= 30; $i++) {
            $data = [
                'title'         => 'Title ' . $i,
                'slug'          => 'Title-' . $i,
                'file_name'     => 'File Name ' . $i,
                'track_list'    => 'Track List 1<br /> Track List 2<br /> Track List 3<br /> Track List 4<br /> Track List 5',
                'type_download' => array_rand([0,1]),
                'status'        => array_rand([0,1]),
                'created_at'    => date('Y-m-d H:i:s'),
            ];
            array_push($filesInfo, $data);
        }
        $tagId = [];
        for ($i = 1; $i <= 51; $i++) {
            array_push($tagId, $i);
        }

        foreach ($filesInfo as $f) {
            $fileInfo = new FilesInfo();
            $fileInfo->title = $f['title'];
            $fileInfo->slug = $f['slug'];
            $fileInfo->file_name = $f['file_name'];
            $fileInfo->track_list = $f['track_list'];
            $fileInfo->type_download = $f['type_download'];
            $fileInfo->status = $f['status'];
            $fileInfo->created_at = $f['created_at'];
            $fileInfo->save();
            $fileInfo->categories()->sync(rand(1,31));
            $random3TagKey = array_rand($tagId, 3);
            $random3Tag = [];
            foreach ($random3TagKey as $item) {
                array_push($random3Tag, $tagId[$item]);
            }
            $fileInfo->tags()->sync($random3Tag);
        }
    }
}
