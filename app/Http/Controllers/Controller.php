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

    public static function upload_image($image)
    {
        $time = Carbon::now();
        $file_path = "uploads/images/{$time->year}/{$time->month}/{$time->day}";
        $file_name = $image->getClientOriginalName();
        $file_name = $time->timestamp . "-{$file_name}";
        $image->move(public_path($file_path) , $file_name);
        $file = $file_path . $file_name;
        return $file;
    }

    public static function upload_images($image)
    {
        $time = Carbon::now();
        $file_path = "uploads/images/{$time->year}/{$time->month}/{$time->day}";
        $file_name = $image->getClientOriginalName();
        $file_name = $time->timestamp . "-{$file_name}";
        $image->move(public_path($file_path) , $file_name);
        $file = $file_path . $file_name . '|' ;
        return $file;
    }
}
