<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Email ou senha inválidos.',
            ]);
        }

        $user->tokens()->delete();

        $access_token = $user->createToken($data['device_name'])->plainTextToken;

        return response()->json([
            'access_token' => $access_token,
        ]);
    }

    public function me()
    {
        $user = auth()->user();

        return response()->json($user);
    }

    public function logout()
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Usuário deslogado com sucesso.',
        ], Response::HTTP_OK);
    }
}
