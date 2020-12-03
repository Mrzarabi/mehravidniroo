<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(BannerRequest $request)
    {
        $banner = new Banner();
        if($request->hasFile('image')) {

            $image = $this->upload_image( $request->file('image') );
            $banner->create( array_merge($request->all(), [
                'image' => $image
                ]) 
            );
        } else {
            
            $banner->create( $request->all() );
        }

        return response([
            'data' => 'بنر با موققیت ثبت شد',
            'status' => 'success'
        ]);
        // return view()->back()->with('بنر شما با موفقیت ثبت شد');
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
    public function update(BannerRequest $request, Banner $banner)
    {
        if($request->hasFile('image')) {
            $image = $this->upload_image($request->file('image'));
        } else {
            $image = $banner->image;
        }
        $banner->update(array_merge($request->all(), [
                'image' => $image
            ] 
        ));
        
        return response([
            'data' => 'بنر با موفقیت به روز رسانی شد',
            'status' => 'success' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response([
            'data' => 'دسته بندی با موفقیت حذف شد',
            'status' => 'success'
        ]);
    }
}
