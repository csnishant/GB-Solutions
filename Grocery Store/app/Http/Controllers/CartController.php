<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller {
    // Cart dikhana

    public function index() {
        $cart = session()->get( 'cart', [] );

        // Fetch categories for header/search
        $categories = Category::all();

        return view( 'cart.index', compact( 'cart', 'categories' ) );
    }

    // Cart me product add karna

    public function add( Request $request, $id ) {
        $product = Product::findOrFail( $id );
        $cart = session()->get( 'cart', [] );

        if ( isset( $cart[ $id ] ) ) {
            $cart[ $id ][ 'quantity' ] += 1;
        } else {
            $cart[ $id ] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put( 'cart', $cart );

        return redirect()->route( 'cart.index' )->with( 'success', 'Product added to cart!' );
    }

    // Cart se product remove karna

    public function remove( $id ) {
        $cart = session()->get( 'cart', [] );

        if ( isset( $cart[ $id ] ) ) {
            unset( $cart[ $id ] );
            session()->put( 'cart', $cart );
        }

        return redirect()->route( 'cart.index' )->with( 'success', 'Product removed!' );
    }

    // Order place karna ( simplified )

    public function placeOrder( Request $request ) {
        $request->validate( [
            'address' => 'required|string',
            'mobile'  => 'required|string|min:10|max:15'
        ] );

        $cart = session()->get( 'cart', [] );

        if ( !$cart ) {
            return redirect()->route( 'cart.index' )->with( 'error', 'Cart is empty!' );
        }

        foreach ( $cart as $id => $item ) {
            Order::create( [
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => $item[ 'quantity' ],
                'total' => $item[ 'price' ] * $item[ 'quantity' ],
                'address' => $request->address,
                'mobile' => $request->mobile,
                'status' => 'Pending',
            ] );
        }

        session()->forget( 'cart' );

        return redirect()->route( 'orders.index' )->with( 'success', 'Apka order accept kar liya gaya, update apko jldi di jayegi!' );
    }
}
