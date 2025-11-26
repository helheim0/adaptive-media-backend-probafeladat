<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Book::insert([
        [
            'id' => 1,
            'title' => 'The Lord of The Rings - The Fellowship of the Ring',
            'author_id' => 1,
            'category_id' => 1,
            'release_date' => Carbon::parse('1954-07-29'),
            'price_huf' => '7000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
         [
            'id' => 2,
            'title' => '1984',
            'author_id' => 2,
            'category_id' => 2,
            'release_date' => Carbon::parse('1949-06-09'),
            'price_huf' => '5000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        ]);
    }
}
