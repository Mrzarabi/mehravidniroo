<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Images\ImageRequest;
use App\Http\Requests\V1\MultiDeleteProduct\MultiDeleteProductRequest;
use App\Http\Requests\V1\Product\ProductRequest;
use App\Http\Resources\Api\V1\Product\Product as ProductResource;
use App\Http\Resources\Api\V1\Product\ProductCollection;
use App\Models\Category;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(9);
        return new ProductCollection($products);
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
    public function store(ProductRequest $request)
    {
        $product = auth()->user()->products()->create( array_merge( $request->all()) );
        $post = new ProductResource($product);

        return response([
            'data' => $post->id,
            'message' => 'محصول با موفقیت ثبت گردید', 
            'status' => 'success'
        ]);
    }

    /**
     * Store a newly created images in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(ImageRequest $request, Product $product)
    {
        if($request->images )
        {
            $images = $request->images;
            foreach ($images as $image) {
                
                $file = $this->upload_image($image);
                $product->images()->create(['image' => $file]);
            }

            return response([
                'data' => 'تصاویر با موفقیت آپلود شدند',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
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
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $post = new ProductResource($product);

        return response([
            'data' => $post->id,
            'data' => 'محصول مورد نظر با موفقیت به روز رسانی شد',
            'status' => 'success'
       ]);
    }

    /**
     * Store a newly created images in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUpload(ImageRequest $request, Product $product)
    {
        if($request->images)
        {
            $images = $request->images;
            foreach ($images as $image) {
                
                $file = $this->upload_image($image);
                $product->images()->update(['image' => $file]);
            }
        } else {
            $product->images()->update(['image' => $product->images()->image]);
        }

        return response([
            'data' => 'تصاویر با موفقیت به روز رسانی شدند',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return [
            'data' => 'محصول با موفقیت حذف شد',
            'status' => 'success'
        ];
    }

    public function multiDelete(MultiDeleteProductRequest $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            DB::table('products')->where('id', $id)->delete();
        }

        return response([
            'data' => 'محصولات با موفقیت حذف شدند',
            'status' => 'success'
        ]);
    }
}
