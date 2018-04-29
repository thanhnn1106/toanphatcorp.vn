<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'name'        => 'Ngan Luong',
                'description' => 'Ngan Luong',
                'type'        => 'budget',
                'created_at'  => date(DATETIME_FORMAT),
            ),
        );
        foreach ($data as $item) {
            $row = PaymentMethod::where('type', $item['type'])->first();
            if ($row === null) {
                DB::table('payments_method')->insert($item);
            }
        }
    }
}
