@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-bold mb-4">{{ $product->name }}</h2>
    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}" 
         class="w-full h-40 object-cover rounded-lg mb-4">

    <form method="POST" action="{{ route('cart.order') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <!-- Quantity -->
        <div class="flex items-center mb-4">
            <button type="button" onclick="changeQty(-1)" class="px-3 py-1 bg-gray-200 rounded">-</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1" 
                   class="mx-2 w-16 text-center border rounded">
            <button type="button" onclick="changeQty(1)" class="px-3 py-1 bg-gray-200 rounded">+</button>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label class="block text-sm font-semibold">Address</label>
            <textarea name="address" class="w-full border rounded p-2" required></textarea>
        </div>

        <!-- Mobile -->
        <div class="mb-3">
            <label class="block text-sm font-semibold">Mobile Number</label>
            <input type="text" name="mobile" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
            Place Order
        </button>
    </form>
</div>

<script>
    function changeQty(val) {
        let qty = document.getElementById("quantity");
        let newVal = parseInt(qty.value) + val;
        if(newVal >= 1) qty.value = newVal;
    }
</script>
@endsection
