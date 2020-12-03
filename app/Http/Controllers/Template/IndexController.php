<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->take(3)->get();
        // return $banners;
        return view('Template.Layouts.index', [
            'banners' => $banners,
        ]);
    }
}
