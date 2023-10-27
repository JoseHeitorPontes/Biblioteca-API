<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $category = Category::create($data);

        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json([], 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = Category::findOrFail($id);
        $category->update($data);

        return response()->json($category);
    }
}
