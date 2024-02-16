<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Http\Resources\CategoriesCollection;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $categories = $category->paginate(10);

        return new CategoriesCollection($categories);
    }

    public function store(StoreUpdateCategoryRequest $request)
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

    public function update(StoreUpdateCategoryRequest $request, int $id)
    {
        $category = Category::find($id);

        if (!$category) {
            throw ValidationException::withMessages(['category' => 'Categoria não existente!']);
        }

        $data = $request->validated();
        $category->update($data);

        return response([
            $category,
        ], Response::HTTP_OK);
    }
}
