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
        $categoryName = $request->categoryName;
        $category = $request->category;

        $books = Book::with('category')
            ->when($categoryName, function (Builder $query) use ($categoryName) {
                $query->where('name', 'linke', "%$categoryName%");
            })
            ->when($category, function (Builder $query) use ($category) {
                $query->whereHas('category', function (Builder $query) use ($category) {
                    $query->where('name', $category);
                });
            })
            ->paginate(8);

        return new BookCollection($books);
    }
}
