<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Manage Products';
        $products = Product::all();
        return view('admin.products', ['products' => $products, 'title' => $title]);
    }
}
