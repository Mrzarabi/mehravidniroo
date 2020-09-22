<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\User as UserResource;
use App\Http\Resources\Api\V1\User\UserCollection;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
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

    public function attachRole(User $user) 
    {
        if(auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399')) {
            if(! $user->hasRole('3362c127-65aa-4950-b14f-2fc86b53ea88') ) {

                $user->attachRole('3362c127-65aa-4950-b14f-2fc86b53ea88');
            }
            return response([
                'data' => "کاربر {$user->name} {$user->family} با موفقیت به کاربران ویژه اضافه شد",
                'status' => 'success'
            ]);
        }
    }

    public function detachRole(User $user) 
    {
        if(auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399')) {
            $user->detachRole('3362c127-65aa-4950-b14f-2fc86b53ea88');
            return response([
                'data' => "کاربر {$user->name} {$user->family} با موفقیت از کاربران ویژه حذف شد",
                'status' => 'success'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
