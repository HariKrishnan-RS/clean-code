<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function index(Request $request)
{
    return redirect()->route('login.show');
}

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);
        if ($token) {
            return response()->json(['token' => $token, 'message' => 'Login successful']);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);

    }
}
