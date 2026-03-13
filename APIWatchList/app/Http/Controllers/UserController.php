<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
         $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:6'
         ]);
         $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password'])
         ]);
         $token = $user->createToken('api-token')->plainTextToken;
         return response()->json([
            'user' => $user,
            'token' => $token
         ],201); 
    }
    public function login(Request $request){

          $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
          ]);

          if(!Auth::attempt($validated)){
             return response()->json([
                'message' => 'Identifiants invalides'
             ],401);
          }
          $token = $request->user()->createToken('api-token');
          return response()->json([
            'token' => $token->plainTextToken
          ]);
    }
    public function logout(Request $request){
       $request->user()->currentAccessToken()->delete();
       return response()->json([
        'message' => 'Logged out successfully'
       ]);
    }
    public function infos(Request $request){
        return response()->json([
            $request->user()
        ]);
    }
}
