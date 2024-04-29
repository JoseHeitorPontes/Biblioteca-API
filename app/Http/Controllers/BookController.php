<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBookRequest;
use App\Http\Resources\BooksCollection;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(2);

        return new BooksCollection($books);
    }

    public function store(StoreUpdateBookRequest $request)
    {
        $data = $request->validated();

        if (isset($request->image)) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            Storage::putFileAs('books', $request->file('image'), $fileName);

            $data['image'] = $fileName;
        }

        $book = Book::create($data);

        return response()->json($book, Response::HTTP_OK);
    }
}
