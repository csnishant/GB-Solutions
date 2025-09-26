<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>
   <div style="text-align:center; margin-top:50px;">
    <h1>{{ $product->name }}</h1>
    @if($product->image)
        <img src="/uploads/{{ $product->image }}" alt="{{ $product->name }}" style="width:300px; height:300px; object-fit:cover; margin:20px 0;">
    @endif
    <h2 style="color:green;">Price: ${{ $product->price }}</h2>
    <h3>Category: {{ $product->category->name }}</h3>
</div>
w
</body>
</html>
