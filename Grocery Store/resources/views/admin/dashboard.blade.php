<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { background-color:#1a1a1a; color:#f0f0f0; font-family: Arial,sans-serif; margin:0; padding:0; }
        header { padding:20px; text-align:center; background-color:#111; }
        header h1 { margin:0; font-size:2rem; }
        .container { max-width:1200px; margin:auto; padding:20px; }
        .form-section { background-color:#222; padding:20px; border-radius:8px; margin-bottom:30px; }
        input, select { width:100%; padding:8px; margin:10px 0; border-radius:5px; border:none; }
        .btn { background-color:#4caf50; color:#fff; padding:10px 15px; border:none; border-radius:5px; cursor:pointer; }
        .btn:hover { background-color:#45a049; }
        h2 { margin-top:0; }
        .success { color:#0f0; }
        .products-list, .categories-list { margin-top:20px; }
        .item { background-color:#333; padding:10px; margin-bottom:10px; border-radius:5px; }
    </style>
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
</header>
<div class="container">

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <!-- Add Category -->
    <div class="form-section">
        <h2>Add Category</h2>
        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Category Name" required>
            <button class="btn" type="submit">Add Category</button>
        </form>

        <div class="categories-list">
            <h3>Existing Categories</h3>
            @foreach($categories as $category)
                <div class="item">{{ $category->name }}</div>
            @endforeach
        </div>
    </div>

    <!-- Add Product -->
    <div class="form-section">
        <h2>Add Product</h2>
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="file" name="image" accept="image/*">
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Add Product</button>
        </form>

        <div class="products-list">
            <h3>Existing Products</h3>
            @foreach($products as $product)
                <div class="item">{{ $product->name }} - ₹{{ $product->price }} - {{ $product->category->name ?? '' }}</div>
            @endforeach
        </div>
    </div>

</div>
</body>
</html>
