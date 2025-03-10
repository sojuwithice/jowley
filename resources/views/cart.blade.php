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
    </div>
</header>

<!-- Shopping Cart Section -->
<section class="shopping-cart">
    <h2 class="cart-title">Your Shopping Cart <i class="fas fa-shopping-bag"></i></h2>

    <div class="cart-container">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Product Items -->
                <tr class="cart-item">
                    <td class="product-info">
                        <input type="checkbox" class="item-checkbox">
                        <img src="image/fuzzy-flower.jpg" alt="Mini Fuzzy Flower White" class="product-img">
                        <div class="product-details">
                            <p class="nameproduct">Mini Fuzzy Flower</p>
                            <p class="product-description">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
                            <div class="product-variation">
                                <label>Variation:</label>
                                <select class="variation-select">
                                    <option value="White" selected>White</option>
                                    <option value="Pink">Pink</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Red">Red</option>
                                    <option value="Purple">Purple</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td class="unit-price">40.00</td>
                    <td class="quantity">
                        <button class="minus-btn">-</button>
                        <input type="text" class="quantity-input" value="1">
                        <button class="plus-btn">+</button>
                    </td>
                    <td class="total-price">40.00</td>
                    <td><button class="delete-btn">Delete</button></td>
                </tr>
            </tbody>
        </table>

        <!-- Checkout Section -->
        <div class="checkout-section">
            <label><input type="checkbox" id="select-all"> Select all</label>
            <span class="total-price-summary">Total (0 items): <strong>0.00</strong></span>
            <button class="checkout-btn">Checkout</button>
        </div>
    </div>
</section>


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

</body>
</html>
