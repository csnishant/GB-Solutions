@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-xl rounded-xl p-6 mt-10">

    <h2 class="text-2xl font-bold text-center mb-6">Edit Product</h2>

    <form method="POST" action="{{ url('/product/update/'.$product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Price</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Current Image</label>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="w-32 h-32 object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">Update Product</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="block mt-4 text-center text-gray-500 hover:underline">Back to Dashboard</a>
</div>
@endsection
