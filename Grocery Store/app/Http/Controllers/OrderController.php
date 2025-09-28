<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
 {
    public function index()
 {
        $user = auth()->user();
        if ( !$user ) {
            return redirect()->route( 'login' );
            // ya error handle karo
        }

        // relation se direct query -> hamesha collection milega
        $orders = $user->orders()->with( 'product' )->get();

        return view( 'orders.index', compact( 'orders' ) );
    }

    public function store( Request $request )
 {
        $request->validate( [
            'address' => 'required|string',
            'mobile' => 'required|string',
        ] );

        $cart = session( 'cart' );
        if ( !$cart ) {
            return redirect()->back()->with( 'error', 'Cart is empty!' );
        }

        $order = auth()->user()->orders()->create( [
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => 'pending',
        ] );

        foreach ( $cart as $id => $item ) {
            $order->products()->attach( $id, [
                'quantity' => $item[ 'quantity' ],
                'price' => $item[ 'price' ],
            ] );
        }

        session()->forget( 'cart' );

        return redirect()->route( 'orders.index' )->with( 'success', 'Order placed successfully!' );
    }
}
