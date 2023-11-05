<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Manage Products';
        $products = Product::orderByDesc('updated_at')->get();
        return view('admin.products', ['products' => $products, 'title' => $title]);
    }

    public function create(Request $request)
    {
        $title = 'Create a new Product';
        return view('admin.products-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);


        try {
            DB::BeginTransaction();
            $image = $request->file('image');
            $path = $image->store('public/images');
            $url = 'storage/' . str_replace('public/', '', $path);


            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $url,
            ]);

            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $request->category,
            ]);

            DB::commit();

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.products')->with(['success' => 'Product created successfully']);
    }

    public function edit(Request $request)
    {
        $product = Product::findOrFail($request->productId);
        $title = 'Edit Product';
        return view('admin.products-edit', ['product' => $product, 'title' => $title]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg|max:4096',
        ]);


        try {
            DB::BeginTransaction();

            $product = Product::findOrFail($request->productId);

            $url = $product->image;

            if ($request->image){
                $image = $request->file('image');
                $path = $image->store('public/images');
                $url = 'storage/' . str_replace('public/', '', $path);
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $url,
            ]);

            ProductCategory::where('product_id', $request->productId)->update([
                'category_id' => $request->category,
            ]);

            DB::commit();

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.products')->with(['success' => 'Product updated successfully']);
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return back()->with(['success' => 'Product deleted successfully']);
    }
}
