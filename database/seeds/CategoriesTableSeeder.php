<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array();
        for ($i = 0; $i <= 30; $i++) {
            $data = [
                'name' => 'Category ' . $i,
                'description' => 'track 1<br />track 2<br />track 3<br />track 4',
                'slug' => 'Category-' . $i,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            array_push($categories, $data);
        }

        foreach ($categories as $c) {
            $chkCate = Category::where('name', $c['name'])->first();
            if ($chkCate === NULL) {
                DB::table('categories')->insert($c);
            }
        }
        Category::saveCateToFile();
    }
}
