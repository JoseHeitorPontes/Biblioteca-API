<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Models\Book;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $book = Book::create($data);

        return response()->json($book);
    }

    public function index(Request $request)
    {
        $bookName = $request->bookName;
        $categoryName = $request->categoryName;

        $books = Book::with('category')
            ->when($bookName, function (Builder $query) use ($bookName) {
                $query->where('name', 'linke', "%$bookName%");
            })
            ->when($categoryName, function (Builder $query) use ($categoryName) {
                $query->whereHas('category', function (Builder $query) use ($categoryName) {
                    $query->where('name', $categoryName);
                });
            })
            ->paginate(8);

        return new BookCollection($books);
    }
}
