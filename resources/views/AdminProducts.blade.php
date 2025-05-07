<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700;900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        body {
            font-family: 'Gabarito', sans-serif;
        }
        /* Ensure both text and icons turn black on hover */
        nav li a:hover,
        nav li a:hover .title,
        nav li a:hover .icon ion-icon {
            color: black !important;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 h-full w-64 bg-pink-600 border-l-8 border-pink-600 flex flex-col overflow-hidden">
        <div class="px-6 py-8">
            <a href="#" class="text-white font-oleo text-3xl select-none block font-['Oleo_Script_Swash_Caps']">Jowley's Crafts</a>
        </div>
        <ul class="flex flex-col mt-4 px-0 flex-grow">
            <li class="mb-3">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Dashboard</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('analytics') }}"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="analytics-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Analytics</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('products.addProduct') }}"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="cube-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Products</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('admin.products') }}"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Inventory</span>
                </a>
            </li>
            <li class="mb-3">
             <a href="#"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Settings</span>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('logout') }}"
                    class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
                    <span class="icon text-2xl flex justify-center w-14 mr-4">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title text-m">Sign Out</span>
                </a>
            </li>
        </ul>
    </nav>

    <main class="ml-64 p-6 w-full">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Manage Products</h2>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
            <table class="table-sm min-w-[1200px] w-full text-sm text-left text-gray-700 bg-white">
                <thead class="bg-pink-600 text-white text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Sold</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Colors</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $product->id }}</td>
                        <td class="px-4 py-3">
                            @php
                            $defaultImage = 'default.jpg';
                            $rawImages = $product->images;
                            $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
                            $imageFilename = $images[0] ?? $defaultImage;
                            $imageFilename = str_replace('\\', '/', $imageFilename);
                            $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
                            @endphp
                            <img src="{{ asset($finalPath) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-md">
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $product->slug }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ Str::limit($product->description, 50) }}</td>
                        <td class="px-4 py-3 font-semibold">₱{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $product->rating }}</td>
                        <td class="px-4 py-3">{{ $product->sold }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ is_array($product->available_colors) ? implode(', ', $product->available_colors) : $product->available_colors }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <button type="button" class="px-3 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-800 transition"
                                data-bs-toggle="modal" data-bs-target="#editProductModal"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-slug="{{ $product->slug }}"
                                data-description="{{ $product->description }}"
                                data-price="{{ $product->price }}"
                                data-rating="{{ $product->rating }}"
                                data-stock="{{ $product->stock }}"
                                data-colors="{{ is_array($product->available_colors) ? implode(', ', $product->available_colors) : $product->available_colors }}">
                                Edit
                            </button>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-pink-500 text-white rounded-md hover:bg-pink-600 transition"
                                    onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($products->isEmpty())
                    <tr>
                        <td colspan="11" class="p-4 text-center text-gray-500">No products found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <input type="number" name="rating" step="0.1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Available Colors</label>
                            <input type="text" name="available_colors" class="form-control" placeholder="Comma separated" required>
                        </div>
                    </div>
                    <div class="modal-footer p-3 bg-gray-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary bg-pink-600 hover:bg-pink-700 border-none">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Required for modals) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal population script -->
    <script>
        const editModal = document.getElementById('editProductModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const productId = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const slug = button.getAttribute('data-slug');
            const description = button.getAttribute('data-description');
            const price = button.getAttribute('data-price');
            const rating = button.getAttribute('data-rating');
            const stock = button.getAttribute('data-stock');
            const colors = button.getAttribute('data-colors');

            const form = document.getElementById('editProductForm');
            form.action = `/admin/products/${productId}`;
            form.querySelector('input[name="name"]').value = name;
            form.querySelector('input[name="slug"]').value = slug;
            form.querySelector('textarea[name="description"]').value = description;
            form.querySelector('input[name="price"]').value = price;
            form.querySelector('input[name="rating"]').value = rating;
            form.querySelector('input[name="stock"]').value = stock;
            form.querySelector('input[name="available_colors"]').value = colors;
        });
    </script>
</body>

</html>