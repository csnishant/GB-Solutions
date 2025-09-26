@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-6">

    <!-- Category Card -->
    <div class="w-full md:w-1/3 bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition">
        <h2 class="text-xl font-semibold mb-4 text-center">Add Category</h2>
        <form method="POST" action="{{ route('admin.category.store') }}" class="flex flex-col gap-3">
            @csrf
            <input type="text" name="name" placeholder="Category Name" class="border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">Add Category</button>
        </form>
    </div>

    <!-- Product Card -->
    <div class="w-full md:w-2/3 bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition">
        <h2 class="text-xl font-semibold mb-4 text-center">Add Product</h2>
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data" class="flex flex-col gap-3">
            @csrf
            <input type="text" name="name" placeholder="Product Name" class="border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none" required>
            <input type="number" name="price" placeholder="Price" class="border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none" required>
            <input type="file" name="image" accept="image/*" class="border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none">
            <select name="category_id" class="border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-400 focus:outline-none" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition">Add Product</button>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4 text-center">All Products</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-2xl shadow-xl p-4 hover:shadow-2xl transition flex flex-col items-center">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded-xl mb-3">
            @else
                <div class="w-32 h-32 bg-gray-100 flex items-center justify-center rounded-xl mb-3 text-gray-400">No Image</div>
            @endif
            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
            <p class="text-gray-500">${{ $product->price }}</p>
            <p class="text-gray-400 text-sm">{{ $product->category->name ?? '-' }}</p>

            <div class="flex gap-3 mt-3">
                <a href="{{ url('/product/edit/'.$product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-xl hover:bg-blue-600 transition text-sm">Edit</a>
                <form method="POST" action="{{ url('/product/delete/'.$product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-xl hover:bg-red-600 transition text-sm">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
