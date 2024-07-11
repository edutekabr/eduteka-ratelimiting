<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'Rafael',
                'email' => 'example@eduteka.com.br',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'Hemelli',
                'email' => 'example2@eduteka.com.br',
                'password' => Hash::make('456')
            ]
        ]);
    }
}
