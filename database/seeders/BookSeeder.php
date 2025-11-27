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
       Book::insert(
        [
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
            [
                'id' => 3,
                'title' => 'The Lord of The Rings - 2',
                'author_id' => 1,
                'category_id' => 1,
                'release_date' => Carbon::parse('1954-07-29'),
                'price_huf' => '4800',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'title' => 'The Lord of The Rings - 3',
                'author_id' => 2,
                'category_id' => 2,
                'release_date' => Carbon::parse('1949-06-09'),
                'price_huf' => '8000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'title' => '198ddd4',
                'author_id' => 2,
                'category_id' => 3,
                'release_date' => Carbon::parse('1949-06-09'),
                'price_huf' => '50000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'title' => '19q4',
                'author_id' => 2,
                'category_id' => 3,
                'release_date' => Carbon::parse('1949-06-09'),
                'price_huf' => '8000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
