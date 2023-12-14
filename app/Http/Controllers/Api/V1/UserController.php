<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;

use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Requests\V1\StoreUserRequest;

//use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection(User::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Auth::user() && (Auth::user()->tokenCan('admin') || (Auth::user()->id == $user->id ))) {
            if (!Auth::user()->tokenCan('admin')) {
                $user->update($request->all());
            } else {
                $user->update($request->except('admin','email'));
            }
        } else {
            return response()->json(['message' => 'Not authorized'], 401);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password_actual' => 'required|string',
            'password_nueva' => 'required|min:8|string'
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('password_actual'), $auth->password))
        {
            return response()->json(['error', "Current Password is Invalid"], 400);
        }

        // Current password and new password same
        if (strcmp($request->get('password_actual'), $request->password_nueva) == 0)
        {
            return response()->json(["error", "New Password cannot be same as your current password."], 400);
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->password_nueva);
        $user->save();
        return response()->json(['message' => 'Password Changed Successfully'], 200);
    }


}
