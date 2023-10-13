<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        $check = [
            "name" => $request->username,
            "password" => $request->password
        ];

        if (Auth::attempt($check)) {
            $request->session()->regenerate();
            $token = $request->user()->createToken("token");
            $result = [
                "token" => $token->plainTextToken,
                "username" => $request->user()->name
            ];
            return response()->json($result, 200);
        }

        return response()->json(["success" => false, "message" => "認証失敗"], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return response()->json(["success" => true]);
    }
}
