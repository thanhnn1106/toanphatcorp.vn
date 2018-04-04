<?php

use Illuminate\Database\Seeder;
use App\Countries;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = array();
        $file = fopen(dirname(__FILE__)."/data/countries.csv","r");
        while(! feof($file)) {
            $tempData = fgetcsv($file, 1, ',');
            if ($tempData !== false) {
                foreach ($tempData as $row) {
                    $part = explode('|', $row);
                    if (count($part) > 1) {
                        $data = array(
                            'code'      => trim($part[0]),
                            'name'      => trim($part[1]),
                            'created_at'  => date('Y-m-d H:i:s'),
                        );
                        $countries[] = $data;
                    }
                }
            }
        }
        fclose($file);

        foreach ($countries as $country) {
            $row = Countries::where('code', $country['code'])->first();
            if ($row === null) {
                DB::table('countries')->insert($country);
            }
        }
    }
}
