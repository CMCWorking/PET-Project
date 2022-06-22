<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\CustomerInformations;
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

        $customers = CustomerInformations::get('id')->toArray();

        for ($i = 0; $i <= 10; $i++) {
            Address::create([
                'customer_id' => $customers[array_rand($customers)]['id'],
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
