<?php

namespace App\Http\Controllers\api;

use App\Helpers\api_formatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class auth_controller extends Controller
{
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email','password'))) {
            return api_formatter::create_api(401, 'Unauthorized');
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return api_formatter::create_api(200, ['email'=> $request['email'], 'token'=>$token]);
    }

    public function logout() {
        Auth::user()->tokens()->delete();

        return api_formatter::create_api(200, 'Logout successful');
    }
}
