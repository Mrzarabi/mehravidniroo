<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validData = $this->validate($request, [
            'email' => 'required|email|string|max:255|exists:users',
            'password' => 'required|string|min:6'
        ]);

        if(! Auth::attempt( $validData ) ){
            return response([
                'data' => 'اطلاعات شما صحیح نمی باشد',
                'status' => 'error'
            ], 403);
        }

        return new UserResource(auth()->user());
    }

    public function register(Request $request) 
    {

        $validData = $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'email' => $validData['email'],
            'password' => bcrypt($validData['password']),
            'api_token' => Str::random(100)
        ]);

        return new UserResource($user);
    }
}
