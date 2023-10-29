<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getProductCategory(Category $category)
    {
        $products = $category->products;
        $title = "Menu | Abou Arab";
        return view('pages.menu', ['title' => $title, 'products' => $products]);
    }
}
