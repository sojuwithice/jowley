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
    <link rel="stylesheet" href="css/cart.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    @if(Auth::check())
    <a href="#" class="notification">
        <i class="fas fa-bell"></i> Notification
    </a>
    <a href="#" class="user-profile" id="profileMenuTrigger">
        <i class="fas fa-user"></i> {{ Auth::user()->username }}
    </a>

    <div id="profileMenu" class="profile-menu">
        <ul>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">My Purchases</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
@else
    <a href="{{ url('/Register') }}" class="signup">Sign Up</a>
    <a href="{{ route('LoginSignUp') }}" class="login">Log in</a>
@endif


<div id="profileMenu" class="profile-menu">
    <ul>
        <li><a href="#">My Profile</a></li>
        <li><a href="#">My Purchases</a></li>
        <li><a href="{{ route('startingpage') }}">Logout</a></li>
    </ul>
</div>

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
                <!-- Dynamically Display Cart Items -->
                @foreach($cartItems as $item) 
                <tr class="cart-item" data-id="{{ $item->id }}"> 
                    <td class="product-info">
                        <input type="checkbox" class="item-checkbox">
                        <img src="{{ asset('storage/'  . $item->product->images[0]) }}" alt="{{ $item->product->name }}">
                    <div class="product-details">
                            <p class="nameproduct">{{ $item->product->name }}</p>
                            <p class="product-description">{{ $item->product->description }}</p>
                            <div class="product-colors">
                            @if($item->product->available_colors && count($item->product->available_colors) > 0)
                                <label>Colors:</label>
                                <select class="colors-select">
                                @php
                $availableColors = is_string($item->product->available_colors) ? json_decode($item->product->available_colors, true) : $item->product->available_colors;
            @endphp
            @foreach($availableColors as $color)
                <option value="{{ $color }}" {{ $color == $item->color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
            @endforeach
        </select>
    @endif
                                </select>
                            </div>
                        </div>
                    </td>
                    <td class="unit-price">{{ number_format($item->product->price, 2) }}</td>
                    <td class="quantity">
                        <button class="minus-btn">-</button>
                        <input type="text" class="quantity-input" value="{{ $item->quantity }}">
                        <button class="plus-btn">+</button>
                    </td>
                    <td class="total-price">{{ number_format($item->quantity * $item->product->price, 2) }}</td>
                    <td><button class="delete-btn">Delete</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Checkout Section -->
        <div class="checkout-section">
            <label><input type="checkbox" id="select-all"> Select all</label>
            <span class="total-price-summary">Total ({{ count($cartItems) }} items): <strong>{{ number_format($cartTotal, 2) }}</strong></span>

            <!-- Form to Redirect to Checkout -->
            <form action="{{ route('checkout') }}" method="GET">
                <button type="submit" class="checkout-btn">Checkout</button>
            </form>
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
   
});
document.getElementById('profileMenuTrigger').addEventListener('click', function(event) {
        event.preventDefault();
        const profileMenu = document.getElementById('profileMenu');
        profileMenu.style.display = (profileMenu.style.display === 'block') ? 'none' : 'block';
    });

    // Close the profile menu if clicked outside
    window.addEventListener('click', function(event) {
        const profileMenu = document.getElementById('profileMenu');
        if (!event.target.closest('#profileMenuTrigger') && !event.target.closest('#profileMenu')) {
            profileMenu.style.display = 'none';
        }
    });


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
            const cartItemRow = item.closest(".cart-item");
            const productId = cartItemRow.dataset.id; // Get the productId from data-id

            // Send an AJAX request to delete the item from the database
            fetch(`/cart/delete/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                // Check if the response is OK
                if (!response.ok) {
                    throw new Error('Failed to delete item from the cart.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    cartItemRow.remove(); // Remove the item from the cart table
                    updateCartTotal(); // Update the total price after deletion
                } else {
                    alert('Failed to delete item from the cart.');
                }
            })
            .catch(error => {
                console.error('Error deleting cart item:', error);
                alert(error.message);
            });
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
</script>

</body>
</html>
