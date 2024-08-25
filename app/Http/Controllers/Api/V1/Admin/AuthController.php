<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $token = auth()->user()->createToken('UserToken')->accessToken;
            return response()->json([
                'token' => $token,
                'code' => 200
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    public function logout()
    {
        \auth()->check() && Auth::user()->tokens()->delete();
        return response()->json(['message' => 'با موفقیت از حساب خود خارج شدید']);
    }
}
