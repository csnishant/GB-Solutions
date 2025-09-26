<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    // Dashboard view
    public function dashboard() {
        $categories = Category::all();
        $products = Product::with('category')->get(); // Category ke saath load karein
        return view('admin.dashboard', compact('categories', 'products'));
    }

    // Store Category
    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create(['name' => $request->name]);

        return back()->with('success', 'Category added successfully!');
    }

    // Store Product
    public function storeProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);

        return back()->with('success', 'Product added successfully!');
    }
}
