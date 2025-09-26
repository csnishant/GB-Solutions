@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-gray-800">Grocery Store</h1>
                <p class="text-sm text-gray-500 hidden md:block">Fresh products delivered to your door!</p>
            </div>

            <!-- Search + Category Filter -->
            <form method="GET" action="{{ route('products.search') }}" class="flex flex-col md:flex-row gap-3 mt-4 md:mt-0 w-full md:w-auto items-center">
    
    <!-- Search Input -->
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition placeholder-gray-400">
    
    <!-- Category Select -->
    <select name="category"
            class="px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 transition text-gray-700">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    
    <!-- Search Button -->
    <button type="submit"
            class="px-6 py-3 bg-green-500 text-white font-semibold rounded-xl shadow hover:bg-green-600 hover:shadow-md transition">
        Search
    </button>
</form>

        </div>
    </header>

    <!-- Products Section -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col hover:shadow-lg transition duration-300 group">
                    
                    <div class="overflow-hidden rounded-xl mb-3">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" 
                             alt="{{ $product->name }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <h3 class="font-semibold text-gray-900 text-base mb-1 group-hover:text-green-500 transition-colors">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-500 text-sm mb-3">{{ $product->category?->name ?? 'No Category' }}</p>

                    <div class="mt-auto flex justify-between items-center">
                        <span class="text-green-600 font-bold text-lg">₹{{ $product->price }}</span>
                        <button class="px-3 py-1 bg-green-500 text-white rounded-xl text-sm hover:bg-green-600 transition">
                            Add
                        </button>
                    </div>
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-500 text-lg">No products found.</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
