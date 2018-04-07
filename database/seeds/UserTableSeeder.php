<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = config('site.roles');
        $status = config('site.user_status.value.active');
        $users = [
            array(
                'user_name'  => 'admin',
                'password'   => bcrypt('123456'),
                'role_id'    => $role['administrator'],
                'status'     => $status,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'user_name'  => 'manage',
                'password'   => bcrypt('123456'),
                'role_id'    => $role['manage'],
                'status'     => $status,
                'created_at' => date(DATETIME_FORMAT),
            ),
        ];

        foreach ($users as $user) {
            $chkUser = User::where('user_name', $user['user_name'])->first();
            if ($chkUser === NULL) {
                DB::table('user')->insert($user);
            }
        }
    }
}
