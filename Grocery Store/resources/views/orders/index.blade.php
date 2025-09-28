@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Your Orders</h2>

    @if($orders->count())
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow p-4 flex flex-col space-y-2">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">{{ $order->product->name }}</h3>
                    <span class="px-3 py-1 rounded-full text-white
                        {{ $order->status=='Pending' ? 'bg-yellow-500' : ($order->status=='Accepted' ? 'bg-green-500' : 'bg-gray-500') }}">
                        {{ $order->status }}
                    </span>
                </div>
                <p>Qty: {{ $order->quantity }}</p>
                <p>Total: ₹{{ $order->total }}</p>
                <p>Address: {{ $order->address }}</p>
                <p>Mobile: {{ $order->mobile }}</p>
                <p class="text-sm text-gray-500">Ordered on: {{ $order->created_at->format('d M, Y') }}</p>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 mt-6">You have not placed any orders yet.</p>
    @endif
</div>
@endsection
