<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;

class NewController extends Controller
{
    public function index()
    {
        return view('admin.new.index');
    }

}

