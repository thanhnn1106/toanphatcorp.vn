<?php

use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array();
        for ($i = 0; $i <= 50; $i++) {
            $data = [
                'name'       => 'Tag ' . $i,
                'slug'       => 'tag-' . $i,
                'is_popular'  => rand(0,1),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            array_push($tags, $data);
        }

        foreach ($tags as $t) {
            $chkTag = Tags::where('name', $t['name'])->first();
            if ($chkTag === NULL) {
                DB::table('tags')->insert($t);
            }
        }
    }
}
