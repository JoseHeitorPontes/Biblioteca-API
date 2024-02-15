<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        Category::create($data);

        return response()->json($data, Response::HTTP_OK);
    }
}
