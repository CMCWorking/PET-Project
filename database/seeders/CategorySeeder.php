<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 20; $i++) {
            DB::table('categories')->insert([
                'name' => 'Danh mục ' . $i,
                'description' => 'Mô tả của danh mục ' . $i,
                'slug' => Str::slug('Danh mục ' . $i),
                'image' => $faker->imageUrl(640, 640, 'products', true),
                'keywords' => 'keyword ' . $i,
                'parent_id' => null,
            ]);
        }
    }
}
