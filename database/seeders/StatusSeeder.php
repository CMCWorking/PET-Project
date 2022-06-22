<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $className = ['danger', 'success', 'warning', 'info'];
        $type = ['order_status', 'payment_status', 'shipping_status'];

        for ($i = 1; $i <= 5; $i++) {
            DB::table('statuses')->insert([
                'name' => 'Trạng thái ' . $i,
                'description' => 'Mô tả của trạng thái ' . $i,
                'classname' => $className[array_rand($className)],
                'type' => $type[array_rand($type)],
            ]);
        }
    }
}
