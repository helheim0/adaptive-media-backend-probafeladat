<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
        [
            'id' => 1,
            'name' => 'Fantasy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'id' => 2,
            'name' => 'Sci-Fi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'id' => 3,
            'name' => 'Romance',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        ]);
    }
}
