<?php

namespace App\Http\Controllers;

use App\Http\Requests\V1\Template\SortDataRequest;
use App\Http\Resources\Api\V1\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * upload images 
     */
    public static function upload_image($image)
    {
        $time = Carbon::now();
        $file_path = "uploads/images/{$time->year}/{$time->month}/{$time->day}/";
        $file_name = $image->getClientOriginalName();
        $file_name = $time->timestamp . "-{$file_name}";
        $image->move(public_path($file_path) , $file_name);
        $file = $file_path . $file_name;
        return $file;
    }

    /** 
     * Return 8 product for index template 
     */
    public function resentProduct()
    {
        $products = Product::latest()->paginate(8);
        return new ProductCollection($products);
    }

    public function sortProduct(SortDataRequest $request) 
    {
        if($request->sort == 'newest') 
        {
            $products = Product::latest()->paginate(9);
            return new ProductCollection($products);
        }

        if($request->sort == 'oldest')
        {
            $products = Product::paginate(9);
            return new ProductCollection($products);
        }

        
        if($request->sort == 'expensive')
        {
            if( auth()->user() ) {

                $user = auth()->user();
                if( $user->hasRole([
                    '3362c127-65aa-4950-b14f-2fc86b53ea88',
                    '100e82ba-e1c0-4153-8633-e1bd228f7399' ])) {
                        $products = Product::orderBy('u_price', 'DESC')->paginate(9);
                    } else {
                        $products = Product::orderBy('c_price', 'DESC')->paginate(9);
                    }
                return new ProductCollection($products); 
            } else {
                $products = Product::orderBy('c_price', 'DESC')->paginate(9);
                return new ProductCollection($products);
            }
        }

        if($request->sort == 'cheapest')
        {
            if( auth()->user() ) {

                $user = auth()->user();
                if( $user->hasRole([
                    '3362c127-65aa-4950-b14f-2fc86b53ea88',
                    '100e82ba-e1c0-4153-8633-e1bd228f7399' ])) {
                        $products = Product::orderBy('u_price', 'ASC')->paginate(9);
                    } else {
                        $products = Product::orderBy('c_price', 'ASC')->paginate(9);
                    }
                return new ProductCollection($products); 
            } else {
                $products = Product::orderBy('c_price', 'ASC')->paginate(9);
                return new ProductCollection($products);
            }
        }
    } 
}
