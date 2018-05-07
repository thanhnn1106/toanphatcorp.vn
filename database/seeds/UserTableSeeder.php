<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = config('site.user_status.value.active');
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'user_name'  => $faker->name,
                'full_name'  => $faker->name,
                'email'      => $faker->email,
                'password'   => bcrypt($faker->password),
                'status'     => rand(0,1),
                'created_at' => date(DATETIME_FORMAT),
            ]);
        }
    }
}
