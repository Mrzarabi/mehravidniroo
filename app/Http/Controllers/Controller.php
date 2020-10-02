<?php

namespace App\Http\Controllers;

use App\Http\Requests\V1\Template\SortDataRequest;
use App\Http\Resources\Api\V1\Product\ProductCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    /**
     * Return all product with spesial condition 
     */
    public function sortProduct(SortDataRequest $request, $specialProduct = null) 
    {
        /**
         * Sort products with newest
         */
        if($request->sort == 'newest') 
        {
            $products = Product::latest()->paginate(9);
            return new ProductCollection($products);
        }

        /**
         * Sort products with oldest
         */
        if($request->sort == 'oldest')
        {
            $products = Product::paginate(9);
            return new ProductCollection($products);
        }

        /**
         * Sort product with expensive
         */
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

        /**
         * Sort product with cheapest 
         */
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

    /**
     * Return products with filters 
     */
    public function filterData(Request $request) 
    {
        $min = $request->min ? $request->min : 0;
        $max = $request->max ? $request->max : 9999999;
        if(auth()->user()) {
            $user = auth()->user();
            
            if($user->hasRole([
                '100e82ba-e1c0-4153-8633-e1bd228f7399', 
                '3362c127-65aa-4950-b14f-2fc86b53ea88']) ) {

                if($request->category) {

                    $products =  Product::where('category_id', $request->category);
                    $products = $products->whereBetween('u_price', [$min, $max])->paginate(9);
                } else {
        
                    $products = Product::whereBetween('u_price', [$min, $max])->paginate(9);
                } 
                return new ProductCollection($products);

            } elseif ($user->hasRole('40dd0ea1-c598-47f7-b138-a8055f0b5c64')) {
               
                if($request->category) {

                    $products =  Product::where('category_id', $request->category);
                    $products = $products->whereBetween('c_price', [$min, $max])->paginate(9);
                } else {
        
                    $products = Product::whereBetween('c_price', [$min, $max])->paginate(9);
                }   
                return new ProductCollection($products); 
            }
        } else {
            
            if($request->category) {
                
                $products =  Product::where('category_id', $request->category);
                $products = $products->whereBetween('c_price', [$min, $max])->paginate(9);
            } else {
                
                $products = Product::whereBetween('c_price', [$min, $max])->paginate(9);
            }
            return new ProductCollection($products);
        }
    }
}
