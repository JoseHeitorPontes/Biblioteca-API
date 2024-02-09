<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        User::create($data);

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso.',
        ], 200);
    }
}
