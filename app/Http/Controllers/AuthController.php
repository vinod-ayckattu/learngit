<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:15|confirmed',
        ]);

        User::create([
            'name' => ucwords($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password)
        ]);

        $users = User::all();
        return response()->json($users);
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return redirect()->back()->with('wrong', 'Invalid credentials!');
        }
        
        if(Hash::check($request->password, $user->password))
        {
            auth()->login($user);
            if(auth()->user())
                {
                    echo auth()->user()->name;
                }
        }
        else{
            echo 'Wrong password';
        }
    }
}
