<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'manager',
            ],
            [
                'name' => 'client',
            ]
        ]);

        User::factory()->create([
            'name' => 'Test Manager',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
    }
}
