<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Ticket\TicketRequest;
use App\Http\Requests\V1\User\UserRequest;
use App\Http\Resources\Api\V1\User\User as UserResource;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if($request->hasFile('avatar')) {
            $image = $this->upload_image($request->file('avatar'));
        } else {
            $image = $user->avatar;
        }

        $user->update( array_merge($request->all()), [
            'avatar' => $image
        ]);

        return response([
            'data' => 'اطلاعات شما با موفقیت به روز رسانی شد',
            'status' => 'success'
        ]);
    }
}
