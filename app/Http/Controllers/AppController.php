<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function user()
    {
        $user = Auth::user();
        return response()->json(['status' => true, "message" => $user], 200);
    }

    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user->id)) {
            return response()->json(["status" => false, "message" => "User already exists."], 401);
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;

        $user->save();
        return response()->json(["status" => true, "message" => "User created successfully."], 200);
    }

    public function login(Request $request)
    {
        if (!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(["status" => false, "message" => "Invalid credentials"]);
        }

        return response()->json(["status" => true, "message" => $token]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/auth/login');
    }
}
