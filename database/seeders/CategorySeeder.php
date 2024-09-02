<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Furniture', 'Electronics', 'Food', 'Cutlery', 'Entertainment'];


        foreach($categories as $c)
        {
            DB::table('categories')->insert([
                'name' => $c
            ]);
        }
        
    }
}
