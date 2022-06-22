<?php

namespace Database\Seeders;

use App\Models\Address;
use Buihuycuong\Vnfaker\VNFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        Schema::disableForeignKeyConstraints();
        DB::table('addresses')->truncate();

        for ($i = 0; $i <= 10; $i++) {
            Address::create([
                'customer_id' => 1,
                'street' => VNFaker::address(),
                'city_id' => Str::random(2),
                'state_id' => Str::random(2),
                'ward_id' => Str::random(2),
                'name' => VNFaker::fullname(),
                'phone' => VNFaker::mobilephone(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
