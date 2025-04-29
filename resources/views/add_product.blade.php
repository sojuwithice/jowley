<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .form-section {
            margin-bottom: 20px;
        }

        .form-section h5 {
            margin-bottom: 15px;
        }

        .image-upload-box {
            border: 2px dashed #ccc;
            padding: 40px;
            text-align: center;
            color: #999;
            cursor: pointer;
        }

        .image-upload-box:hover {
            background-color: #f8f8f8;
        }

        .btn-discard {
            background: none;
            border: none;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Add Product</h2>
        <form action="{{ route('products.storeProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Left column -->
                <div class="col-md-6">
                    <div class="form-section">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-section">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="form-section">
                        <label for="image" class="form-label">Display Image</label>
                        <div class="image-upload-box">
                            Drag your photo here or <input type="file" id="image" name="image" class="form-control mt-2" required>
                        </div>
                    </div>
                </div>

                <!-- Right column -->
                <div class="col-md-6">
                    <div class="form-section">
                        <h5>Organize</h5>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category">
                                <option selected>Accesories</option>
                                <option selected>Bouquet</option>
                                <option selected>Bracelet</option>
                                <option selected>Clothes</option>
                                <option selected>Keychains</option>
                                <option selected>Phone Accesories</option>
                                <option selected>Wallet/option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organization</label>
                            <input type="text" class="form-control" name="organization" value="Circuits">
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm mb-3">Add Category +</button>
                    </div>

                    <div class="form-section">
                        <h5>Inventory</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option selected>Low </option>
                                    <option>Out of Stock</option>
                                </select>
                            </div>
                        <div class="mb-3">
                            <label class="form-label">Variation</label>
                            <input type="text" class="form-control" name="variation" value="Disabled" disabled>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" value="250" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="stock" value="1" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-4 text-end">
                <button type="reset" class="btn btn-discard">Discard</button>
                <button type="submit" class="btn btn-primary">Publish Product</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
