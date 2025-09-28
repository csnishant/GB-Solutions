<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store - Customer Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Header -->
<header class="bg-white sticky top-0 z-50 shadow px-4 py-3">
    <!-- Top Header: Logo + Icons -->
    <div class="flex justify-between items-center mb-3">
        <!-- Logo -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Grocery Store</h1>
            <p class="text-sm text-gray-500">Fresh products delivered to your door!</p>
        </div>

        <!-- Icons -->
        <div class="flex items-center space-x-4">
            <!-- Cart Icon -->
           <a href="{{ route('cart.index') }}" class="relative">
    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9h14l-2-9M10 21a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0z"/>
    </svg>
    @php
        $cartCount = count(session('cart', []));
    @endphp
    @if($cartCount > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
            {{ $cartCount }}
        </span>
    @endif
</a>


            <!-- Orders Icon -->
            <a href="{{ route('orders.index') }}">
                <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0h-4m0 0H5m14 0v-6a2 2 0 00-2-2H7a2 2 0 00-2 2v6m16 0H3"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Bottom Header: Search + Category Filter -->
    <form method="GET" action="{{ route('customer.home') }}" class="flex flex-col md:flex-row gap-3 items-center">
        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 placeholder-gray-400 transition">

        <select name="category"
                class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 text-gray-700 transition">
            <option value="">All</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="px-6 py-2 border border-green-500 text-green-500 font-semibold rounded-lg hover:bg-green-500 hover:text-white transition">
            Go
        </button>
    </form>
</header>

<!-- Main Content -->
<main class="p-4">
    <!-- Category Chips -->
    <div class="flex overflow-x-auto gap-3 py-3 px-1 scrollbar-hide">
        @foreach($categories as $category)
            <a href="{{ route('customer.home', ['category' => $category->id]) }}"
               class="flex-none px-4 py-2 rounded-full border border-gray-300 text-gray-700
                      hover:bg-green-100 hover:text-green-700 transition
                      {{ request('category') == $category->id ? 'bg-green-500 text-white border-green-500' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 gap-4 mt-4">
        @foreach($products as $product)
            <div class="bg-white rounded-xl shadow p-3 flex flex-col">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}" 
                     alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-lg mb-2">
                <h3 class="font-semibold text-gray-800 text-sm">{{ $product->name }}</h3>
                <p class="text-gray-500 text-xs mt-1">{{ $product->category?->name ?? 'No Category' }}</p>
                <div class="mt-auto flex justify-between items-center">
                    <span class="text-green-600 font-bold">₹{{ $product->price }}</span>
                    <a href="{{ route('cart.add', $product->id) }}" 
                    class="px-2 py-1 bg-green-500 text-white rounded-md text-xs hover:bg-green-600">
                     Add
                     </a>
                </div>
            </div>
        @endforeach
    </div>
</main>

<footer class="mt-6 text-center text-gray-500 text-xs pb-4">
    &copy; 2025 Grocery Store
</footer>

</body>
</html>
