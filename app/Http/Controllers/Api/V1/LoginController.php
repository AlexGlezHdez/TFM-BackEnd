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

    $abilities = $admin ? ['admin'] : ['none'];

    return response()->json([
      'token' => $request->user()
        ->createToken($request->device, $abilities)
        ->plainTextToken,
      'message' => 'Success',
      'id' => $request->user()->id
    ]);
  }

  public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();
    // auth()->user()->tokens()->delete();
    return response()->json([
      'message' => 'Logged out'
    ]);
  }

  public function admin(Request $request) {
    $datos=$request->user();
    $user = Auth::user();

    if (Auth::user()->admin) {
      return response()->json(['message' => 'Access granted'], 200);
    } else {
      return response()->json(['message' => 'Access denied'], 401);
    }
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