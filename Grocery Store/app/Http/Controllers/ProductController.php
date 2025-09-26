<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('product', ['product' => $product]);
    }

    public function byCategory($id) {
        $products = Product::where('category_id', $id)->get();
        return view('products', ['products' => $products]);
    }

    // Show form
public function create() {
    $categories = \App\Models\Category::all();
    return view('create_product', ['categories' => $categories]);
}

// Store product
public function store(Request $request) {
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'image' => 'nullable|image|max:2048'
    ]);

    $data = $request->only(['name','price','category_id']);

    // Handle image upload
    if($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['image'] = $filename;
    }

    \App\Models\Product::create($data);

    return redirect('/')->with('success','Product added successfully!');
}







}
