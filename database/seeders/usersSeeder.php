<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'type_user' => 'admin',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'lucas',
            'email' => 'lucas@gmail.com',
            'type_user' => 'user',
            'password' => Hash::make('123456789'),
        ]);
    }
}
