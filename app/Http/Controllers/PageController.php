<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $title = "Home | Abou Arab";
        return view('pages.home', ['title' => $title]);
    }

    public function menu()
    {
        $title = "Menu | Abou Arab";
        $products = Product::all();
        return view('pages.menu', ['title' => $title, 'products' => $products]);
    }

    public function bag(){
        $title = "Bag | Abou Arab";
        $products = Cart::where('user_id', auth()->user()->id)->with(['product'])->get()->pluck('product');
        return view('pages.bag', ['title' => $title, 'products' => $products]);
    }

    public function contact(){
        $title = "ContactUs | Abou Arab";
        return view('pages.contact', ['title' => $title]);
    }

    public function about(){
        $title = "AboutUs | Abou Arab";
        return view('pages.about', ['title' => $title]);
    }



}
