<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store - Customer Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-white sticky top-0 z-50 shadow px-4 py-3 flex flex-col items-center">
    <h1 class="text-2xl font-bold text-gray-800">Grocery Store</h1>
    <p class="text-sm text-gray-500">Fresh products delivered to your door!</p>

    <!-- Search + Category Filter -->
    <form method="GET" action="{{ route('customer.home') }}" class="w-full mt-3 flex gap-2">
        <input type="text" name="search" placeholder="Search products..." 
               value="{{ request('search') }}"
               class="flex-1 px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
        <select name="category" class="px-3 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400">
            <option value="">All</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600">Go</button>
    </form>
</header>

<main class="p-4">
    <!-- Category Chips -->
    <div class="flex overflow-x-auto gap-3 py-3">
        @foreach($categories as $category)
            <a href="{{ route('customer.home', ['category' => $category->id]) }}"
               class="flex-none px-4 py-2 bg-white rounded-full shadow hover:bg-green-100
                      {{ request('category') == $category->id ? 'bg-green-500 text-white' : '' }}">
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
                    <button class="px-2 py-1 bg-green-500 text-white rounded-md text-xs hover:bg-green-600">Add</button>
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
