<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller {
    // Show product details

    public function show( $id ) {
        $product = Product::findOrFail( $id );
        return view( 'product', [ 'product' => $product ] );
    }

    // Products by category

    public function byCategory( $id ) {
        $products = Product::where( 'category_id', $id )->get();
        return view( 'products', [ 'products' => $products ] );
    }

    // Show create product form

    public function create() {
        $categories = Category::all();
        return view( 'create_product', [ 'categories' => $categories ] );
    }

    // Store product

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048'
        ] );

        $imagePath = null;
        if ( $request->hasFile( 'image' ) ) {
            $imagePath = $request->file( 'image' )->store( 'products', 'public' );
        }

        Product::create( [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ] );

        return redirect( '/' )->with( 'success', 'Product added successfully!' );
    }

    // Edit product

    public function edit( $id ) {
        $product = Product::findOrFail( $id );
        $categories = Category::all();
        return view( 'admin.product_edit', compact( 'product', 'categories' ) );
    }

    // Update product

    public function update( Request $request, $id ) {
        $product = Product::findOrFail( $id );
        $request->validate( [
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'nullable|image|max:2048'
        ] );

        $data = $request->only( [ 'name', 'price', 'category_id' ] );

        if ( $request->hasFile( 'image' ) && $request->file( 'image' )->isValid() ) {
            $data[ 'image' ] = $request->file( 'image' )->store( 'products', 'public' );
        }

        $product->update( $data );
        return redirect()->route( 'admin.dashboard' )->with( 'success', 'Product updated successfully' );
    }

    // Delete product

    public function destroy( $id ) {
        $product = Product::findOrFail( $id );
        if ( $product->image ) {
            \Storage::disk( 'public' )->delete( $product->image );
        }
        $product->delete();
        return back()->with( 'success', 'Product deleted successfully' );
    }

}
