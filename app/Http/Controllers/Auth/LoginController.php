<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(["status" => false, "message" => "Invalid credentials"]);
        }

        return response()->json(["status" => true, "message" => $token]);
    }

    public function signout()
    {
        Auth::logout();
    }
}
