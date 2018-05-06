<?php

use Illuminate\Database\Seeder;
use App\Models\Contacts;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('contacts')->insert([
                'name'       => $faker->name,
                'email'      => $faker->email,
                'title'      => $faker->jobTitle,
                'message'    => $faker->internetExplorer,
                'status'     => rand(0,2),
                'created_at' => date(DATETIME_FORMAT),
            ]);
        }
    }
}
