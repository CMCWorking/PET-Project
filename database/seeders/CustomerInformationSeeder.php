<?php

namespace Database\Seeders;

use Buihuycuong\Vnfaker\VNFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $engine = ['facebook', 'google', 'email'];
        DB::table('customer_informations')->insert([
            'name' => VNFaker::fullname(),
            'email' => VNFaker::email(['gmail.test', 'cmcglobal.test']),
            'phone' => VNFaker::mobilephone(),
            'password' => Hash::make(Str::random(10)),
            'received_promotion' => VNFaker::boolean(),
            'login_engine' => $engine[array_rand($engine)],
            'account_key' => VNFaker::generateOrderNo(10),
        ]);
    }
}
