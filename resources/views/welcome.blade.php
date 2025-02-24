<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between">
        <h1 class="text-2xl font-bold">Jewelry Store</h1>
        <a href="#" class="text-blue-600">Cart (0)</a>
    </nav>

    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-4">Our Collection</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 shadow-md rounded-lg">
                <img src="https://via.placeholder.com/200" alt="Necklace" class="w-full h-40 object-cover rounded">
                <h3 class="text-lg font-bold mt-2">Gold Necklace</h3>
                <p class="text-gray-600">$299</p>
                <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Add to Cart</button>
            </div>
            <div class="bg-white p-4 shadow-md rounded-lg">
                <img src="https://via.placeholder.com/200" alt="Bracelet" class="w-full h-40 object-cover rounded">
                <h3 class="text-lg font-bold mt-2">Silver Bracelet</h3>
                <p class="text-gray-600">$149</p>
                <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Add to Cart</button>
            </div>
        </div>
    </div>
</body>
</html>
