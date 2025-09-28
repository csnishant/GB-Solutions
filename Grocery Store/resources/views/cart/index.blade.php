@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Your Cart</h2>

    @if($cart)
    <div class="bg-gray-50 rounded-xl shadow-lg p-4 space-y-4">
        @php $grandTotal = 0; @endphp
        @foreach($cart as $id => $item)
            @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
            <div class="flex items-center justify-between bg-white rounded-xl p-3 shadow">
                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/60' }}" 
                     class="w-16 h-16 rounded-lg object-cover">
                <div class="flex-1 mx-4">
                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                    <p class="text-gray-500">₹{{ $item['price'] }}</p>

                    <div class="flex items-center mt-2 space-x-2">
                        <button type="button" onclick="updateQty('{{ $id }}', -1, {{ $item['price'] }})" 
                                class="px-3 py-1 bg-gray-200 rounded-full text-lg">-</button>
                        <input type="number" id="qty-{{ $id }}" value="{{ $item['quantity'] }}" min="1"
                               class="w-12 text-center border rounded-md">
                        <button type="button" onclick="updateQty('{{ $id }}', 1, {{ $item['price'] }})" 
                                class="px-3 py-1 bg-gray-200 rounded-full text-lg">+</button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold">₹<span id="total-{{ $id }}">{{ $total }}</span></p>
                    <a href="{{ route('cart.remove', $id) }}" class="text-red-500 text-sm mt-2 inline-block">Remove</a>
                </div>
            </div>
        @endforeach

        <div class="text-right font-bold text-lg mt-2">
            Grand Total: ₹<span id="grand-total">{{ $grandTotal }}</span>
        </div>

        <!-- Place Order Form -->
        <form method="POST" action="{{ route('cart.order') }}" class="mt-4">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-semibold">Address</label>
                <textarea name="address" class="w-full border rounded p-2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-semibold">Mobile Number</label>
                <input type="text" name="mobile" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                Place Order
            </button>
        </form>
    </div>
    @else
        <p class="text-center text-gray-500 mt-6">Your cart is empty.</p>
    @endif
</div>

<script>
function updateQty(id, delta, price) {
    let qtyInput = document.getElementById('qty-' + id);
    let newQty = parseInt(qtyInput.value) + delta;
    if(newQty < 1) newQty = 1;
    qtyInput.value = newQty;

    // Update product total
    let totalElement = document.getElementById('total-' + id);
    totalElement.innerText = newQty * price;

    // Update grand total dynamically
    let grandTotal = 0;
    document.querySelectorAll('[id^="total-"]').forEach(el => {
        grandTotal += parseInt(el.innerText);
    });
    document.getElementById('grand-total').innerText = grandTotal;

    // Optionally: Send AJAX request to backend to update session
}
</script>
@endsection
