<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed'
            ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Vaildation Failed!',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => strtolower($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password)
        ]);

        auth()->login($user);

        return response()->json([
            'success' => true,
            'message' => 'User Created Successfully !',
            'data' => new UserResource($user)
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Vaildation Failed!',
                'errors' => $validator->errors()
            ], 422);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $token = auth()->user()->createToken('user-'.auth()->id());

            return response()->json([
                'status' => true,
                'message' => 'Logged In Successfully !',
                'token' => $token->plainTextToken,
                'date' => new UserResource(auth()->user())
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid Credentials!',
        ], 401);
        
    }
}
