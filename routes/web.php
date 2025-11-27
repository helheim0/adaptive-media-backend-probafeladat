<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\StatisticsController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-books/{id}', function($id) {
    $controller = new BookController;
    $book = Book::find($id);
    $author = Author::where('id', $book->author_id)->value('name');
    $category = Category::where('id', $book->category_id)->value('name');
    $priceInEur = $controller->getPriceInEur($book->price_huf);

    if (!$book) {
        return response()->json([
            'message' => 'Book not found!'
        ], 404);
    }

    if ($book) {
        return response()->json([
            'book' => [
                'title' => $book->title,
                'author' => $author,
                'category' => $category,
                'release_date' => $book->release_date,
                'price' => $priceInEur . ' EUR'
            ]
        ], 200);
    };
});

Route::get('/expensive-books', function() {
    $books = Book::all();
    $expensiveBooks = collect();
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
});

Route::get('/top-fantasy-and-sci-fi', function() {
    $books = Book::all();
    $categories = ['Fantasy', 'Sci-Fi'];
    $controller = new StatisticsController;

    foreach ($books as $book)
    {
        // Ideally using slugs here
        if ($book->category_id == $controller->getCategory('Fantasy') || $book->category_id == $controller->getCategory('Sci-Fi'))
        {
            return collect($books)
            ->filter(function ($book) use ($categories, $controller) {
                $categoryId = $controller->getCategoryById($book->category_id);
                return in_array($categoryId, $categories);
            })
            ->sortByDesc('price_huf')
            ->take(3);
        }
    }
});