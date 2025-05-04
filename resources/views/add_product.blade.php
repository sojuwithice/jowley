<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Analytics - Top Products by Quantity Sold</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700;900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <style>
        body {
            font-family: 'Gabarito', sans-serif;
        }

        .font-oleo {
            font-family: 'Oleo Script Swash Caps', cursive;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 h-full w-64 bg-pink-600 border-l-8 border-pink-600 flex flex-col overflow-hidden">
        <div class="px-6 py-8">
            <a href="#" class="text-white font-oleo text-3xl select-none block">Jowley's Crafts</a>
        </div>
        <ul class="flex flex-col mt-4 px-0 flex-grow">
            <li class="mb-3">
                <a href="{{ route('dashboard') }}" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Dashboard</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('analytics') }}" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="analytics-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Analytics</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('products.addProduct') }}" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="cube-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Products</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('admin.products') }}" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Inventory</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="#" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Settings</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('logout') }}" class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Sign Out</span>
                </a>
            </li>
        </ul>
    </nav>

    <main class="flex-1 ml-64 p-6">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10 mb-10">
            <h2 class="text-3xl font-lg mb-6">Add Product</h2>
            <form action="{{ route('products.storeProduct') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left column -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                            <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500" />
                        </div>
                        <div>
                            <label for="description" class="block text-gray-700 font-medium mb-2">Product Description</label>
                            <textarea id="description" name="description" rows="5" required class="w-full border border-gray-300 rounded-md px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                        </div>
                        <div>
                            <label for="image" class="block text-gray-700 font-medium mb-2">Display Image</label>
                            <div class="border-2 border-dashed border-pink-400 rounded-md p-6 text-center text-pink-600 cursor-pointer hover:bg-pink-50 transition-colors">
                                <label for="image" class="cursor-pointer">
                                    Drag your photo here or <span class="underline font-semibold">browse</span>
                                    <input type="file" id="image" name="image" required class="hidden" onchange="previewImage(event)" />
                                </label>
                                <img id="imagePreview" class="hidden mx-auto mt-4 max-h-48 rounded-md shadow" />
                            </div>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div class="space-y-8">
                        <div>
                            <h5 class="text-xl font-lg mb-4 text-gray-800">Organize</h5>
                            <div class="mb-4">
                                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                                <select id="category" name="category" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <option>Accessories</option>
                                    <option>Bouquet</option>
                                    <option>Bracelet</option>
                                    <option>Clothes</option>
                                    <option>Keychains</option>
                                    <option>Phone Accessories</option>
                                    <option>Wallet</option>
                                </select>
                            </div>
                            <button type="button" onclick="addCategory()" class="inline-block px-4 py-2 border border-pink-600 text-pink-600 rounded-md hover:bg-pink-600 hover:text-white transition-colors font-medium">
                                Add Category +
                            </button>
                        </div>

                        <div>
                            <h5 class="text-xl font-semibold mb-4 text-gray-800">Inventory</h5>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                                <select id="status" name="status" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <option>Low Stocks</option>
                                    <option>Out of Stock</option>
                                    <option>Available</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="variation" class="block text-gray-700 font-medium mb-2">Variation</label>
                                <input type="text" id="variation" name="variation" value="Disabled" disabled class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed" />
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                                <input type="number" id="price" name="price" value="250" required min="0" step="0.01" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500" />
                            </div>
                            <div>
                                <label for="stock" class="block text-gray-700 font-medium mb-2">Quantity</label>
                                <input type="number" id="stock" name="stock" value="1" required min="0" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500" />
                            </div>
                            <div class="mb-4">
                            <label for="new_arrival" class="block text-gray-700 font-medium mb-2">New Arrival</label>
                            <div class="flex items-center space-x-4">
                                <input type="hidden" name="new_arrival" value="0">
                                <input type="checkbox" id="new_arrival" name="new_arrival" value="1" class="hidden peer">
                            <div onclick="toggleSwitch(this)" class="w-12 h-6 bg-gray-300 rounded-full relative cursor-pointer transition-colors duration-300">
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-300"></div>
                         </div>
                        </div>
                         </div>
                        </div>
                    </div>
                </div>

                <!-- New Arrival -->
                
                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <button type="reset" class="px-6 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100 transition-colors font-medium">
                        Discard
                    </button>
                    <button type="submit" class="px-6 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium">
                        Publish Product
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove("hidden");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addCategory() {
            const newCategory = prompt("Enter new category name:");
            if (newCategory) {
                const select = document.getElementById('category');
                const option = document.createElement('option');
                option.text = newCategory;
                option.value = newCategory;
                select.add(option);
                select.value = newCategory;
            }
        }

        function toggleSwitch(el) {
            const checkbox = el.previousElementSibling;
            checkbox.checked = !checkbox.checked;

            const circle = el.querySelector('div');
            if (checkbox.checked) {
                el.classList.add("bg-pink-500");
                circle.classList.add("translate-x-6");
            } else {
                el.classList.remove("bg-pink-500");
                circle.classList.remove("translate-x-6");
            }
        }
    </script>
</body>

</html>
