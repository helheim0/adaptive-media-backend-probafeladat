<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getExpensiveBooks()
    {
        $books = Book::all();
        $averagePrice = $this->calculateAveragePrice($books);
        $expensiveBooks = collect();

        foreach($books as $book) {
            if($book->price_huf >= $averagePrice) {
                $expensiveBooks->push($book);
            }
        }

        return response()->json([
            'expensive_books' => [
                $expensiveBooks->toArray()
            ]
        ]);
    }

    public function getPopularCategories()
    {

    }

    // Wasn't sure top 3 together or separate, here together
    public function getTopFantasyAndSciFi()
    {
        $books = Book::all();
        $categories = ['Fantasy', 'Sci-Fi'];

        foreach ($books as $book)
        {
            // Ideally using slugs here
            if ($book->category_id == $this->getCategory('Fantasy') || $book->category_id == $this->getCategory('Sci-Fi'))
            {
                return collect($books)
                ->filter(function ($book) use ($categories) {
                    $categoryId = $this->getCategoryById($book->category_id);
                    return in_array($categoryId, $categories);
                })
                ->sortByDesc('price_huf')
                ->take(3);
            }
        }
    }
    
    private function calculateAveragePrice($books)
    {
        $prices = collect();
        $pricesSum = 0;
        $averagePrice = 0;

        foreach($books as $book) {
            $prices->push($book->price_huf);
        }

        foreach($prices as $price) {
            $pricesSum+=$price;
        }

        $averagePrice = $pricesSum/count($prices);

        return $averagePrice;
    }

    // Quick public solution so that I can easily reach from web.php
    public function getCategory($categoryName)
    {
        return Category::where('name', $categoryName)->value('id');
    }

    public function getCategoryById($categoryId)
    {
        return Category::where('id', $categoryId)->value('name');
    }
}
