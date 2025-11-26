<?php

namespace App\Http\Controllers;

use App\Models\Book;
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

    public function getTopFantasyAndSciFi()
    {

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
}
