<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'role' => 1,
            'birthday' => '2001-10-30',
            'avatar' => fake()->imageUrl(),
            'password' => Hash::make('123456')
        ]);

        User::factory(5)->create();

    }
}
