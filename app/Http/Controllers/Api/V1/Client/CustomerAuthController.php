<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'integer|unique:customers',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $customer = Customer::create($validatedData);
        $token = $customer->createToken('CustomerToken', ['customer'])->accessToken;

        return response()->json([
            'success' => true,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        if (Auth::Guard('customer')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $token = auth()->user()->createToken('UserToken')->accessToken;
            return response()->json([
                'token' => $token,
                'code' => 200
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    public function logout(Request $request)
    {
        \auth('customer')->check() && Auth::Guard('customer')->user()->tokens()->delete();
        return response()->json(['message' => 'با موفقیت از حساب خود خارج شدید']);
    }

}
