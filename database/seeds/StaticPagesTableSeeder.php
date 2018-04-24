<?php

use Illuminate\Database\Seeder;
use App\Models\StaticPages;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staticPages = array(
            array(
                'type'        => 'about_us',
                'title'       => 'About us',
                'status'      => 1,
                'slug'        => 'about-us',
                'content'     => null,
                'created_at'  => date(DATETIME_FORMAT),
            ),
            array(
                'type'        => 'privacy_policy',
                'title'       => 'Privacy policy',
                'status'      => 1,
                'slug'        => 'privacy-policy',
                'content'     => null,
                'created_at'  => date(DATETIME_FORMAT),
            ),
            array(
                'type'        => 'dj_tips',
                'title'       => 'DJ Tips',
                'status'      => 1,
                'slug'        => 'dj-tips',
                'content'     => null,
                'created_at'  => date(DATETIME_FORMAT),
            ),
        );
        foreach ($staticPages as $sp) {
            $chkPage = StaticPages::where('type', $sp['type'])->first();
            if ($chkPage === NULL) {
                DB::table('static_pages')->insert($sp);
            }
        }
    }
}
