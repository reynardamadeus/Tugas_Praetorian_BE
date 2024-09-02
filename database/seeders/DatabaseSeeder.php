<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'=> Hash::make('admin123'),
            'phone_number' => '081217601340',
            'role' => 'Admin'
        ]);

        //user
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@gmail.com',
            'password'=> Hash::make('budiman'),
            'phone_number' => '081217601220',
            'role' => 'Guest'
        ]);


        $this->call([
            CategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
