<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1 style="text-align:center;">Add Product</h1>
    <form action="/product/store" method="POST" enctype="multipart/form-data" style="width:300px; margin:0 auto;">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" style="width:100%; margin-bottom:10px;" required><br>

        <label>Price:</label><br>
        <input type="number" name="price" style="width:100%; margin-bottom:10px;" required><br>

        <label>Category:</label><br>
        <select name="category_id" style="width:100%; margin-bottom:10px;" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br>

        <label>Image:</label><br>
        <input type="file" name="image" style="margin-bottom:10px;"><br>

        <button type="submit" style="width:100%; padding:10px;">Add Product</button>
    </form>
</body>
</html>
