<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'name' => 'حازم محمد اسماعيل',
            'username' => 'Hazem',
            'email' => 'hazem.ismail@hotmail.com',
            'is_active' => true,
            'password' => bcrypt('123123123'),
        ]);
    }
}
