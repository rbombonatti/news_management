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
        DB::table('categories')->insert(
            [
                [
                    'title' => 'Geral',
                    'slug' => 'geral',
                ],
                [
                    'title' => 'Economia',
                    'slug' => 'economia',
                ],
                [
                    'title' => 'Política',
                    'slug' => 'politica',
                ],
                [
                    'title' => 'Esportes',
                    'slug' => 'esportes',
                ],
                [
                    'title' => 'Internacional',
                    'slug' => 'internacional',
                ]
            ]
        );
    }
}
