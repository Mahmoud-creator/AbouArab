<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddonsController extends Controller
{
    public function index()
    {
        $title = 'Manage Addons';
        $addons = Addons::all();
        return view('admin.addons', ['addons' => $addons, 'title' => $title]);
    }

    public function destroy(Request $request)
    {
        $addon = Addons::findOrFail($request->addon_id);
        $addon->delete();
        return response()->json(['message' => 'Addon was deleted successfully']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
        ]);


        if (Addons::where('slug', Str::slug($request->name))->first()) {
            return back()->with(['error' => 'Addon already exists']);
        }

        Addons::create([
            'name' => $request->name,
            'price' => $request->price,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with(['success' => 'Addon was created successfully']);
    }
}
