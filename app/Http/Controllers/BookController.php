<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBookRequest;
use App\Http\Resources\BooksCollection;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

    public function show($id)
    {
        $book = Book::with('category')->find($id);

        if (!$book) {
            throw ValidationException::withMessages([ 'book' => 'Livro não existente!']);
        }

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            throw ValidationException::withMessages([ 'book' => 'Livro não existente!']);
        }

        $book->destroy();

        return response()->json([
            'message' => 'Livro excluido com sucesso!',
        ], Response::HTTP_OK);
    }
}
