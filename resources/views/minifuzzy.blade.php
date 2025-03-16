<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/featured.css">
    
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

    <input type="checkbox" name="" id="toggler">
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

<div class="container my-5">
    <div class="row">


    <div class="col-md-6">
    <!-- Main Image Preview -->
    <img id="mainImage" src="image/fuzzy1.jpg" class="img-fluid rounded" alt="Mini Fuzzy Flower">
    
    <!-- Thumbnails -->
    <div class="d-flex mt-3">
        <img src="image/fuzzy1.jpg" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
        <img src="image/fuzzy-flower.jpg" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
        <img src="image/fuzzypink.jpg" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
        <img src="image/fuzzyred.jpg" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
        <img src="image/fuzzylightblue.jpg" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
    </div>
</div>


        <div class="col-md-6">
            <h1 class="fw-bold">Mini Fuzzy Flower</h1>
            <p class="text-warning fw-bold">
             4.9 
            <i class="fas fa-heart text-pink"></i>
            <i class="fas fa-heart text-pink"></i>
            <i class="fas fa-heart text-pink"></i>
            <i class="fas fa-heart text-pink"></i>
            <i class="far fa-heart text-pink"></i>
    <span class="text-dark">(290 ratings)</span> | <span class="text-success">300+ sold</span>
</p>

            <h3 class="text-danger">₱40.00</h3>
            <p>Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
            
        
            <p><strong>Available Colors:</strong></p>
                <div class="color-options">
                <span class="color-circle color-white"></span>
                <span class="color-circle color-pink"></span>
                <span class="color-circle color-lightblue"></span>
                 <span class="color-circle color-purple"></span>
                <span class="color-circle color-blue"></span>
                <span class="color-circle color-red"></span>
</div>
<div class="quantity-container">
    <label class="quantity-label">Quantity</label>
    <div class="quantity-box">
        <button onclick="decreaseQuantity()">−</button>
        <input type="number" id="quantity" min="1" max="100" value="1">
        <button onclick="increaseQuantity()">+</button>
    </div>
    <span class="stock-info">Available Stocks: <span id="stock-count">100</span> pieces</span>
</div>


            <div class="mt-4">
            <button class="btn btn-outline-dark me-2" onclick="showCartModal()">Add To Cart</button>
            <button class="btn btn-danger" onclick="buyNow()">Buy Now</button>
            </div>
        </div>
    </div>
</div>

<div id="cartModal" class="modal-overlay">
    <div class="modal-content">
    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#8b50fc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="12" r="10" />
    <path d="M9 12l2 2 4-4" />
</svg>
        <p>Item has been added to your Shopping Cart!</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="fw-bold">Product Ratings</h2>
    <p class="text-warning fw-bold">⭐ 4.9 out of 5</p>

    <div class="list-group">
        <div class="list-group-item bg-light p-3 rounded mb-2">
            <p class="fw-bold mb-1">Aike Barin ⭐ 5.0</p>
            <small class="text-muted">2021-09-25 21:21 | Variation: Blue</small>
            <p>Excellent quality 👍</p>
        </div>

        <div class="list-group-item bg-light p-3 rounded">
            <p class="fw-bold mb-1">RebeccaJ ⭐ 5.0</p>
            <small class="text-muted">2021-09-25 21:21 | Variation: Pink</small>
            <p>Excellent quality 👍</p>
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

function decreaseQuantity() {
        let quantityInput = document.getElementById("quantity");
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }

    function increaseQuantity() {
        let quantityInput = document.getElementById("quantity");
        let maxStock = parseInt(document.getElementById("stock-count").textContent);
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < maxStock) {
            quantityInput.value = currentValue + 1;
        }
    }

    function changeImage(thumbnail) {
    
        let mainImage = document.getElementById("mainImage");

        mainImage.src = thumbnail.src;
    }
   
function showCartModal() {
    let modal = document.getElementById("cartModal");
    modal.style.display = "flex";

    // Auto-close after 2 seconds
    setTimeout(() => {
        modal.style.display = "none";
    }, 2000);
}





</script>

</body>
</html>
