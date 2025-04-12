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
    <link rel="stylesheet" href="{{ asset('css/featured.css') }}">

    
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

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
        @if(count($product->images) > 1)
                <img id="mainImage" src="{{ asset($product->images[0]) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                <div class="d-flex mt-3">
                    @foreach ($product->images as $image)
                        <img src="{{ asset($image) }}" class="img-thumbnail me-2" width="70" onclick="changeImage(this)">
                    @endforeach
                </div>
            @else
                <img id="mainImage" src="{{ asset($product->images[0]) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @endif
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold">{{ $product->name }}</h1>
            <p class="text-warning fw-bold">
                {{ $product->rating }} 
                @for ($i = 0; $i < floor($product->rating); $i++)
                    <i class="fas fa-heart text-pink"></i>
                @endfor
                <span class="text-dark">({{ $product->rating * 60 }} ratings)</span> | 
                <span class="text-success">{{ $product->sold }}+ sold</span>
            </p>

            <h3 class="text-danger">₱{{ number_format($product->price, 2) }}</h3>
            <p>{{ $product->description }}</p>

            <p><strong>Available Colors:</strong></p>
            <div class="color-options">
            @if(is_array($product->available_colors) || is_object($product->available_colors))
                @foreach ($product->available_colors as $color)
                    <span class="color-circle color-{{ strtolower($color) }}"></span>
                @endforeach
                @endif
            </div>

            <div class="quantity-container">
                <label class="quantity-label">Quantity</label>
                <div class="quantity-box">
    <button type="button" onclick="changeQuantity(-1)">−</button>
    <input type="number" id="quantity" min="1" max="{{ $product->stock }}" value="1">
    <button type="button" onclick="changeQuantity(1)">+</button>
</div>

                <span class="stock-info">Available Stocks: <span id="stock-count">{{ $product->stock }}</span> pieces</span>
            </div>

            <div class="mt-4">
            <form method="POST" action="{{ route('cart.add') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="hidden" name="product_name" value="{{ $product->name }}">
    <input type="hidden" name="image" value="{{ $product->images[0] }}">
    <input type="number" name="quantity" id="quantityInput" min="1" max="{{ $product->stock }}" value="1" class="d-none">
    <button type="submit" class="btn btn-outline-dark me-2">Add To Cart</button>
</form>

                <button class="btn btn-danger" onclick="buyNow()">Buy Now</button>
            </div>
        </div>
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

    
    
   
});

function changeImage(thumbnail) {
    let mainImage = document.getElementById("mainImage");
    let imageInput = document.querySelector('input[name="image"]'); // Get the hidden input
    mainImage.src = thumbnail.src;
    imageInput.value = thumbnail.src; // Update the hidden input with the new image
}

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

    function changeQuantity(amount) {
    const input = document.getElementById('quantity');
    let current = parseInt(input.value);
    let max = parseInt(input.max);
    let newVal = current + amount;
    if (newVal >= 1 && newVal <= max) {
        input.value = newVal;
        document.getElementById('quantityInput').value = newVal;
    }
}


</script>

</body>
</html>
