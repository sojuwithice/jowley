<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts - Admin Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admindash.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
                <h4>Jowley's Crafts</h4>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">Products</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <h2 class="mb-4">Manage Products</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th> <!-- Image column -->
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Sold</th>
                            <th>Stock</th>
                            <th>Available Colors</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <!-- Display the first image if available -->
                                @php
        $defaultImage = 'default.jpg'; // Default image if none exists
        $rawImages = $product->images; // Assuming images are stored as JSON or an array

        // Decode images if they're stored as a string or use the raw array
        $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;

        // Get the first image or use the default
        $imageFilename = $images[0] ?? $defaultImage;

        // Ensure the correct path format
        $imageFilename = str_replace('\\', '/', $imageFilename);

        // If the image path doesn't start with 'image/', prepend it
        $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
    @endphp

    <img src="{{ asset($finalPath) }}" alt="{{ $product->name }}" width="100">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->rating }}</td>
                            <td>{{ $product->sold }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ is_array($product->available_colors) ? implode(', ', $product->available_colors) : $product->available_colors }}</td>
                            <td>
                                <!-- Update Button -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-slug="{{ $product->slug }}"
                                        data-description="{{ $product->description }}"
                                        data-price="{{ $product->price }}"
                                        data-rating="{{ $product->rating }}"
                                        data-stock="{{ $product->stock }}"
                                        data-colors="{{ is_array($product->available_colors) ? implode(', ', $product->available_colors) : $product->available_colors }}">
                                    Update
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($products->isEmpty())
                        <tr>
                            <td colspan="11" class="text-center">No products found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="editProductForm" method="POST" enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productSlug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="productSlug" name="slug" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="productRating" class="form-label">Rating</label>
                        <input type="number" class="form-control" id="productRating" name="rating" step="0.1" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productColors" class="form-label">Available Colors</label>
                        <input type="text" class="form-control" id="productColors" name="available_colors" placeholder="e.g. Red, Blue, Green" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to pass data to the modal and update form action
        var editProductModal = document.getElementById('editProductModal');
        editProductModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var productId = button.getAttribute('data-id');

            var form = document.getElementById('editProductForm');
            form.action = '{{ route("products.update", ["id" => ":id"]) }}'.replace(":id", productId);

            document.getElementById('productName').value = button.getAttribute('data-name');
            document.getElementById('productSlug').value = button.getAttribute('data-slug');
            document.getElementById('productDescription').value = button.getAttribute('data-description');
            document.getElementById('productPrice').value = button.getAttribute('data-price');
            document.getElementById('productRating').value = button.getAttribute('data-rating');
            document.getElementById('productStock').value = button.getAttribute('data-stock');
            document.getElementById('productColors').value = button.getAttribute('data-colors');
        });
    </script>
</body>
</html>
