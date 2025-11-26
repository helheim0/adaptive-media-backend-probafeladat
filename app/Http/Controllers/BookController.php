<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('here');
        $books = Book::all();

        dd($books);
        return response()->json([
            'books' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }

        $author_id = Author::where('name', $request->author)->get('id');
        $category_id = Category::where('name', $request->category)->get('id');

        try {
            Book::create([
                'title' => $request->title,
                'author_id' => $author_id,
                'category_id' => $category_id
            ]);

            return response()->json([
                'message' => 'Book created!'
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => 'Book creation failed!'
            ], 500);
        }
    }

    public function show(string $id)
    {
        $book = Book::find($id);
        $author = Author::where('id', $book->author_id)->value('name');
        $category = Category::where('id', $book->category_id)->value('name');
        $priceInEur = $this->getPriceInEur($book->price_huf);

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
        }
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function getPriceInEur($priceInHuf)
    {
        $request_url = 'https://v6.exchangerate-api.com/v6/7338df23e2a028447add0964/latest/EUR';
        $response_json = file_get_contents($request_url);
        
        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);

                // Check for success
                if('success' === $response->result) {

                    return round(($priceInHuf / $response->conversion_rates->HUF), 2);
                }
            }
            catch(Exception $e) {
                // Handle JSON parse error...
            }
        }
    }
}
