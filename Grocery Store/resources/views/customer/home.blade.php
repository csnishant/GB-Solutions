<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store - Dark Mode</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header { padding: 20px; text-align: center; background-color: #111; position: relative; }
        header h1 { font-size: 2.5rem; margin: 0; }
        header p { margin-top: 5px; color: #aaa; }
        .logout-btn {
            position: absolute;
            right: 20px;
            top: 25px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover { background-color: #c0392b; }

        .container { max-width: 1200px; margin: auto; padding: 20px; }
        h2 { margin-top: 40px; margin-bottom: 20px; font-size: 1.8rem; border-bottom: 1px solid #333; padding-bottom: 5px; }
        .categories, .products { display: flex; flex-wrap: wrap; gap: 20px; }
        .category-card, .product-card { background-color: #222; padding: 15px; border-radius: 8px; text-align: center; flex: 1 1 200px; min-width: 200px; }
        .category-card:hover, .product-card:hover { background-color: #333; }
        .product-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 6px; margin-bottom: 10px; }
        .btn { display: inline-block; padding: 8px 12px; margin-top: 10px; background-color: #4caf50; color: #fff; text-decoration: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
        footer { text-align: center; padding: 20px; margin-top: 40px; border-top: 1px solid #333; color: #aaa; }

        @media (max-width: 768px) { .categories, .products { flex-direction: column; } }
    </style>
</head>
<body>

<header>
    <h1>Grocery Store</h1>
    <p>Fresh products delivered to your door!</p>

    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    @endauth
</header>

<div class="container">
    <!-- Categories -->
    <section>
        <h2>Categories</h2>
        <div class="categories">
            @foreach($categories as $category)
                <div class="category-card">{{ $category->name }}</div>
            @endforeach
        </div>
    </section>

    <!-- Featured Products -->
    <section>
        <h2>Featured Products</h2>
        <div class="products">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>₹{{ $product->price }} {{ $product->category ? '/ ' . $product->category->name : '' }}</p>
                    <a class="btn">Add to Cart</a>
                </div>
            @endforeach
        </div>
    </section>
</div>

<footer>
    &copy; 2025 Grocery Store. All rights reserved.
</footer>

</body>
</html>
