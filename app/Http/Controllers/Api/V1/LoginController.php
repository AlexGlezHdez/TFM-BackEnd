<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function login(Request $request)
  {
    $request->merge(['device' => 'test']);
    $this->validateLogin($request);
    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json([
        'message' => 'Unauthorized'
      ], 401);
    }

    $admin = $request->user()->admin;

    $abilities = $admin ? array(['prueba']) : [];

    return response()->json([
      'token' => $request->user()
        ->createToken($request->device)
        ->plainTextToken,
      'message' => 'Success',
      'id' => $admin
    ]);
  }

  public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
    // auth()->user()->tokens()->delete();
    return response()->json([
      'message' => 'Logged out'
    ]);
  }


  public function validateLogin(Request $request)
  {
    return $request->validate([
      'email' => 'required|email',
      'password' => 'required',
      'device' => 'required'
    ]);
  }
}