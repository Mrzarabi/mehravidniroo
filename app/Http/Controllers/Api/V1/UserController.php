<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\MultiDeleteUser\MultiDeleteUserRequest;
use App\Http\Requests\V1\User\UserRequest;
use App\Http\Resources\Api\V1\User\User as UserResource;
use App\Http\Resources\Api\V1\User\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return $user;
            
        $user->attachRole('40dd0ea1-c598-47f7-b138-a8055f0b5c64');

        return new UserResource($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399')) {
            $users = User::with('roles')
                ->whereNotIn('email', ['owner@gmail.com', 'helper@gmail.com'])
                ->latest()
                ->paginate(10);

            return new UserCollection($users);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if( auth()->user() ) {
            return new UserResource($user);
        }
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
        if( auth()->user()) {
            
            if($request->hasFile('avatar')) {
                $image = $this->upload_image($request->file('avatar'));
            } else {
                $image = $user->avatar;
            }
    
            $user->update(array_merge($request->all(), [
                'avatar' => $image
                ] 
            ));
    
            return response([
                'data' => 'اطلاعات شما با موفقیت به روز رسانی شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            $user->delete();

            return response([
                'data' => 'کاربران مورد نظر با موفقیت حذف شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDelete(MultiDeleteUserRequest $request)
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                DB::table('users')->where('id', $id)->delete();
            }

            return response([
                'message' => 'کاربران با موفقیت حذف شدند',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($query = null)
    {
        $resualt = User::search( $query )->latest()->paginate(10);
        return new UserCollection($resualt);
    }
}
