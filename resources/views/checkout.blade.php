<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 60px;
        }
        .custom-container {
            max-width: 900px;
            margin: auto;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d63384;
        }
        .card {
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .btn-pink {
            background-color: #ff4db8;
            color: white;
            border-radius: 5px;
        }
        .btn-pink:hover {
            background-color: #e60073;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Top header bar -->
<div class="top-header scroll-fade">
    <div class="left">
        <span>Follow us on</span>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
    </div>
    <div class="right">
        <a href="#" class="notification">
            <i class="fas fa-bell"></i> Notification
        </a>
        <a href="#" class="user">
            <i class="fas fa-user"></i> AkosiMJ#01
        </a>
    </div>
</div>

<!-- Header Section -->
<header class="scroll-fade">
    <input type="checkbox" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    
    <a href="#" class="logo">Jowley's Crafts</a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#products">Products</a>
        <a href="#contactus">Contact Us</a>
    </nav>

    <div class="header-right"> 
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="icons">
        <a href="{{ route('cart') }}" class="fas fa-shopping-cart"></a>
</a>
        </div>
    </div>
</header>
    <div class="container custom-container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark fw-bold">Jewley’s Craft</h2>
            <div class="d-flex align-items-center">
                <span class="me-3"><i class="bi bi-bell"></i> Notification</span>
                <span><i class="bi bi-person-circle"></i> AkosiiMJ#01</span>
            </div>
        </div>

        <!-- Products Ordered -->
        <h4 class="fw-bold">Products Ordered</h4>

        <!-- Delivery Address -->
        <div class="card p-3 mb-3">
            <h5 class="section-title">Delivery Address</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>Marijoy Novora</strong> <br>
                    <span>09123456789</span> <br>
                    <small>EM’S Barrio Legazpi City, Albay, South Luzon, 4501<br>
                    Purok 3, EM’S Barrio Legazpi City <br>
                    Sa may malapit sa eskinita sa gilid</small>
                </div>
                <button class="btn btn-pink">Change</button>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card p-3 mb-3">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Variation</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Item Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="image/fuzzy-flower.jpg" alt="Mini Fuzzy Flower" width="80"></td>
                        <td>
                            <strong>Mini Fuzzy Flower</strong><br>
                            <small>Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</small>
                        </td>
                        <td>Variation: Pink</td>
                        <td>₱40.00</td>
                        <td>1</td>
                        <td>₱40.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-end fw-bold">
                Total Order (1 item): ₱40.00
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="card p-3">
            <h5 class="section-title">Payment Methods</h5>
            <div class="d-flex justify-content-between">
                <span>Cash on Delivery</span>
                <button class="btn btn-pink">Change</button>
            </div>
            <hr>
            <div>
                <p>Merchandise Subtotal: <span class="float-end">₱40.00</span></p>
                <p>Shipping Subtotal: <span class="float-end">₱0.00</span></p>
                <p class="fw-bold">Total Payment: <span class="float-end">₱40.00</span></p>
            </div>
        </div>
    </div>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const scrollElements = document.querySelectorAll(".scroll-fade");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            } else {
                entry.target.classList.remove("show");
            }
        });
    }, { threshold: 0.2 });

    scrollElements.forEach((el) => observer.observe(el));

    document.querySelectorAll(".cart-item").forEach((item) => {
        const minusBtn = item.querySelector(".minus-btn");
        const plusBtn = item.querySelector(".plus-btn");
        const quantityInput = item.querySelector(".quantity-input");
        const unitPrice = parseFloat(item.querySelector(".unit-price").textContent);
        const totalPriceElement = item.querySelector(".total-price");
        const itemCheckbox = item.querySelector(".item-checkbox");
        const deleteBtn = item.querySelector(".delete-btn");

        function updateTotal() {
            let quantity = parseInt(quantityInput.value);
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
            }
            quantityInput.value = quantity;
            totalPriceElement.textContent = (quantity * unitPrice).toFixed(2);
            updateCartTotal();
        }

        plusBtn.addEventListener("click", () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotal();
        });

        minusBtn.addEventListener("click", () => {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotal();
            }
        });

        quantityInput.addEventListener("change", updateTotal);
        itemCheckbox.addEventListener("change", updateCartTotal);

        deleteBtn.addEventListener("click", () => {
            item.remove();
            updateCartTotal();
        });
    });

    function updateCartTotal() {
        let total = 0;
        let itemsCount = 0;
        document.querySelectorAll(".cart-item").forEach((item) => {
            const checkbox = item.querySelector(".item-checkbox");
            if (checkbox.checked) {
                total += parseFloat(item.querySelector(".total-price").textContent);
                itemsCount++;
            }
        });

        const totalPriceSummary = document.querySelector(".total-price-summary");
        totalPriceSummary.innerHTML = `Total (${itemsCount} item${itemsCount !== 1 ? "s" : ""}): <strong>${total.toFixed(2)}</strong>`;
    }

    const selectAllCheckbox = document.querySelector("#select-all");
    selectAllCheckbox.addEventListener("change", function () {
        document.querySelectorAll(".item-checkbox").forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateCartTotal();
    });
});
</script>