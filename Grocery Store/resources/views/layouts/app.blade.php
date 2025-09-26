<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-green-500 text-white p-4">
    <h1 class="text-2xl font-bold">Grocery Store</h1>
</header>

<main class="p-4">
    @yield('content')
</main>

</body>
</html>
