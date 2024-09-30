<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'investidor10@investidor10.com.br',
            'password' => bcrypt('investidor10'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
