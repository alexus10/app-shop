<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        //$products = Product::paginate(9);
        $categories = Category::has('products')->get();
        return view('welcome')->with(compact('categories'));
    }
}
