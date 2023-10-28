<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
  public function register(Request $request) {
    $fields = $request->validate([
      'name' => 'required',
      'email' => 'required|unique:users,email',
      'password' => 'required|confirmed'
    ]);

    $user = User::create([
      'name' => $fields['name'],
      'email' => $fields['email'],
      'password' => Hash::make($fields['password']),
    ]);

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token
    ];

    return response($response, 201);
  }


  public function login(Request $request) {
    $fields = $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);



    // check email
    $user = User::where('email', $fields['email'])->first();

    if (!$user || !Hash::check($fields['password'], $user->password)) {
      return response([
        'message' => "Bad credentials."
      ], 401);
    }


    // $token = $user->createToken('myapptoken')->plainTextToken;

    // $response = [
    //   'user' => $user,
    //   'token' => $token
    // ];

    // return response($response, 201);
  }

  public function logout(Request $request) {
    auth()->user()->tokens()->delete($request);

    return [
      'message' => 'logged out'
    ];
  }
}
