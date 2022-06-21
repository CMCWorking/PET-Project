<?php

namespace Database\Seeders;

use Buihuycuong\Vnfaker\VNFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('addresses')->insert([
                'customer_id' => 1,
                'street' => VNFaker::address(),
                'city_id' => Str::random(2),
                'state_id' => Str::random(2),
                'ward_id' => Str::random(2),
                'name' => VNFaker::fullname(),
                'phone' => VNFaker::mobilephone(),
            ]);
        }
    }
}
