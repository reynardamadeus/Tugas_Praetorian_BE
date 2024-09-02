<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Laptop',
            'price' => 4000000,
            'stock' => 3,
            'photo' => '1',
            'category_id' => 2
        ]);
        DB::table('products')->insert([
            'name' => 'Roti',
            'price' => 20000,
            'stock' => 30,
            'photo' => '2',
            'category_id' => 3
        ]);
        DB::table('products')->insert([
            'name' => 'Spoon set',
            'price' => 40000,
            'stock' => 10,
            'photo' => '3',
            'category_id' => 4
        ]);
        DB::table('products')->insert([
            'name' => 'Chair',
            'price' => 1500000,
            'stock' => 3,
            'photo' => '4',
            'category_id' => 1
        ]);
        DB::table('products')->insert([
            'name' => 'Uno Card Set',
            'price' => 50000,
            'stock' => 10,
            'photo' => '5',
            'category_id' => 5
        ]);
    }
}
