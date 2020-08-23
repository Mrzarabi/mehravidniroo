<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function upload_image($image) {

    //     $time = Carbon::now();   
    //     $file_path = "uploads/{$time->year}/{$time->month}/{$time->day}";
    //     $file_ext = $image->getClientOriginalExtension();
    //     $file_name = rtrim($image->getClientOriginalName(), ".$file_ext");
    //     $file_name = time() . '_' . substr($file_name, 0, 30);
        
    //     // Create directories if doesn't exists
    //     if (!file_exists( public_path($file_path) )) {
    //         mkdir(public_path($file_path), 0777, true);
    //     }

    //     $image->move( public_path("$file_path/$file_name.$file_ext") );
    // }

    
    public static function upload_image($image)
    {
        // Create file name & file path with /year/month/day/filename formats
        $time = Carbon::now();   
        $file_path = "uploads/{$time->year}/{$time->month}/{$time->day}";
        $file_ext = $image->getClientOriginalExtension();
        $file_name = rtrim($image->getClientOriginalName(), ".$file_ext");
        $file_name = time() . '_' . substr($file_name, 0, 30);
        
        // Create directories if doesn't exists
        if (!file_exists( public_path($file_path) )) {
            mkdir(public_path($file_path), 0777, true);
        }

        $image->move( public_path("$file_path/$file_name.$file_ext") );
        return "/$file_path/$file_name.$file_ext";
    }
}
