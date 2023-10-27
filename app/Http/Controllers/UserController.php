<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        if (Hash::check($data['password'], $data['confirm_password'])) {
            throw ValidationException::withMessages([
                'credentials' => 'A senha e a confirmação devem ser as mesmas.',
            ]);
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return response()->json([
            "status" => 200,
        ]);
    }
}
