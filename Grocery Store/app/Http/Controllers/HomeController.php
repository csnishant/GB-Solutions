<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
 {
    public function index( Request $request )
 {
        $categories = Category::all();
        // get all categories

        // start query for products
        $products = Product::query();

        // filter by search
        if ( $request->filled( 'search' ) ) {
            $products->where( 'name', 'like', '%' . $request->search . '%' );
        }

        // filter by category
        if ( $request->filled( 'category' ) ) {
            $products->where( 'category_id', $request->category );
        }

        $products = $products->get();
        // get filtered products

        return view( 'customer.home', compact( 'products', 'categories' ) );
    }
}
