<?php

use Illuminate\Database\Seeder;
use App\Models\Packages;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            array(
                'name'         => 'Gói 1',
                'number_month' => 1,
                'price'        => 400000,
                'description'  => '400,000 VNĐ/Tháng',
                'status'       => 1,
                'created_at'   => date(DATETIME_FORMAT),
            ),
            array(
                'name'         => 'Gói 2',
                'number_month' => 3,
                'price'        => 1050000,
                'description'  => '350,000 VNĐ/Tháng',
                'status'       => 1,
                'created_at'   => date(DATETIME_FORMAT),
            ),
            array(
                'name'         => 'Gói 3',
                'number_month' => 12,
                'price'        => 3000000,
                'description'  => '250,000 VNĐ/Tháng',
                'status'       => 1,
                'created_at'   => date(DATETIME_FORMAT),
            ),
        ];

        foreach ($packages as $p) {
            $chkPack = Packages::where('name', $p['name'])->first();
            if ($chkPack === NULL) {
                DB::table('packages_info')->insert($p);
            }
        }
    }
}
