<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $categories = $category->paginate(10);

        return new CategoriesCollection($categories);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Category::create($data);

        return response()->json($data, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json([
            'message' => 'Categoria excluida com sucesso!',
        ], Response::HTTP_OK);
    }
}
