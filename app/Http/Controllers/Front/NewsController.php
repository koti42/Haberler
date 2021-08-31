<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Throwable;

class NewsController extends Controller
{
    public function index()
    {
        return view('front.layouts.master');
    }
}
