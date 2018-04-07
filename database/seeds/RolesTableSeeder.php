<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array(
                'role'        => ROLE_ADMIN,
                'description' => 'Administrators',
                'status'      => 1,
                'created_at'  => date(DATETIME_FORMAT),
            ),
            array(
                'role'        => ROLE_MANAGE,
                'description' => 'Manage',
                'status'      => 1,
                'created_at'  => date(DATETIME_FORMAT),
            ),
        );
        foreach ($roles as $role) {
            $row = Roles::where('role', $role['role'])->first();
            if ($row === null) {
                DB::table('roles')->insert($role);
            }
        }
    }
}
