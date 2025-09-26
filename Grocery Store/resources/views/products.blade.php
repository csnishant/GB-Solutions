<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1 style="text-align:center;">Products</h1>
  <div style="border:1px solid #000; padding:10px; width:180px; text-align:center;">
    <a href="/product/{{ $product->id }}" style="text-decoration:none; color:black;">
        @if($product->image)
            <img src="/uploads/{{ $product->image }}" alt="{{ $product->name }}" style="width:150px; height:150px; object-fit:cover; margin-bottom:5px;">
        @endif
        <div>{{ $product->name }}</div>
        <div style="color:green; font-weight:bold;">${{ $product->price }}</div>
    </a>
</div>

</body>
</html>
