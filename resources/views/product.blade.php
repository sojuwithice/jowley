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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    
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
    <a href="#" class="notification" id="notificationButton">
    <i class="fas fa-bell"></i> Notification
    @if($unreadCount > 0)
        <span class="notification-badge">{{ $unreadCount }}</span>
    @endif
</a>
    <a href="#" class="user-profile" id="profileMenuTrigger">
        <i class="fas fa-user"></i> {{ Auth::user()->username }}
    </a>

    <div id="profileMenu" class="profile-menu">
        <ul>
        <li><a href="{{ route('usersprofile') }}">My Profile</a></li>
                <li><a href="{{ route('purchasepage') }}">My Purchases</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
@else
    <a href="{{ url('/Register') }}" class="signup">Sign Up</a>
    <a href="{{ route('LoginSignUp') }}" class="login">Log in</a>
@endif




    </div>
</div>

<!-- Header Section -->
<header class="scroll-fade">

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    
    <a href="#" class="logo">Jowley's Crafts</a>


    <nav class="navbar">
        <a href="{{ route('homepage') }}">Home</a>
        <a href="{{ route('shop.index') }}">Products</a>
        <a href="{{ route('faqs') }}">FAQs</a>
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

            
            @if(!empty($product->available_colors) && (is_array($product->available_colors) || is_object($product->available_colors)))
    <p><strong>Available Colors:</strong></p>
    <div class="color-options">
        @foreach ($product->available_colors as $color)
            <span class="color-circle color-{{ strtolower($color) }} 
                  @if($loop->first) selected @endif" 
                  data-color="{{ $color }}"
                  onclick="selectColor(this)"></span>
        @endforeach
    </div>
    <input type="hidden" name="color" id="selectedColor" value="{{ $product->available_colors[0] ?? '' }}">
@else
    <input type="hidden" name="color" id="selectedColor" value="N/A">
@endif

<div class="quantity-container">
                    <label class="quantity-label">Quantity</label>
                    <div class="quantity-box">
                        <button type="button" onclick="changeQuantity(-1)">−</button>
                        <input type="number" id="quantity" min="1" max="{{ $product->stock }}" value="1" readonly>
                        <button type="button" onclick="changeQuantity(1)">+</button>
                    </div>
                    <span class="stock-info">Available Stocks: <span id="stock-count">{{ $product->stock }}</span> pieces</span>
                </div>


    <form method="POST" action="{{ route('cart.add') }}" class="add-to-cart-form" id="productForm">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="hidden" name="product_name" value="{{ $product->name }}">
    <input type="hidden" name="image" value="{{ $product->images[0] }}">
    <input type="hidden" id="quantity_input" name="quantity" value="1">
    <input type="hidden" id="selectedColor" name="color" value="{{ $product->available_colors[0] ?? '' }}">
    
    <div class="button-container">
    <button type="submit" class="btn btn-outline-pink me-2" id="addToCartBtn" 
            {{ $product->stock <= 0 ? 'disabled' : '' }}>
        Add To Cart
    </button>
    <button type="button" class="btn btn-outline-pink" id="buyNowBtn" 
        {{ $product->stock <= 0 ? 'disabled' : '' }}>
    Buy Now
    </button>
</div>
</form>



        <!-- Success Modal -->
        <div class="modal fade" id="cartSuccessModal" tabindex="-1" aria-labelledby="cartSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal text-center p-4">
            <div class="checkmark-wrapper mx-auto mb-3">
            <i class="bi bi-check-lg check-icon"></i>
            </div>
            <p class="modal-text">Item has been added to your Shopping Cart</p>
            </div>
        </div>
        </div>

       <!-- Failed to Add Modal -->
       <div class="modal fade" id="cartFailedModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal text-center p-4">
      <div class="error-wrapper mx-auto mb-3">
        <i class="bi bi-exclamation-triangle-fill error-icon"></i>
      </div>
      <p class="modal-text" id="errorMessage">Failed to add to cart</p>
    </div>
  </div>
</div>

        


<div class="list-group">
<h2 class="fw-bold">Product Ratings</h2>
    @foreach($product->ratings as $rating)
        <div class="list-group-item">
            <div class="d-flex align-items-center gap-3 mb-2">
                <p class="fw-bold mb-0">
                    @if($rating->show_username)
                        {{ $rating->user->username ?? 'Anonymous' }}
                    @else
                        Anonymous
                    @endif
                    <i class="bi bi-heart-fill text-danger"></i>
    {{ number_format($rating->services['overall_rating'] ?? 0, 1) }}
                </p>
            </div>

            <small class="text-muted d-block mb-2">
                {{ $rating->created_at->format('Y-m-d H:i') }}
                @if(isset($rating->variation))
                    | Variation: {{ $rating->variation }}
                @endif
            </small>

            <!-- Appearance Review -->
            <div class="mt-2">
                <strong>Appearance Review:</strong>
                <p class="mb-1">{{ $rating->appearance_review ?: 'No comment.' }}</p>
            </div>

            <!-- Material Quality Review -->
            <div class="mt-2">
                <strong>Material Quality Review:</strong>
                <p class="mb-1">{{ $rating->material_quality_review ?: 'No comment.' }}</p>
            </div>

            <!-- Uploaded Photo -->
            @if($rating->image_path)
                <div class="mt-3">
                    <strong>Uploaded Photo:</strong>
                    <div class="image-preview mt-2">
                        <img src="{{ asset('storage/' . $rating->image_path) }}" alt="Review Image" class="img-fluid">
                    </div>
                </div>
            @endif

            <!-- Uploaded Video -->
            @if($rating->video_path)
                <div class="mt-3">
                    <strong>Uploaded Video:</strong>
                    <div class="video-preview mt-2">
                        <video controls>
                            <source src="{{ asset('storage/' . $rating->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    @if($product->ratings->count() > 3)
        <div class="text-center mt-3">
            <a href="{{ route('products.reviews', $product->id) }}" class="btn btn-outline-primary">
                See All Reviews
            </a>
        </div>
    @endif
</div>






</body>


</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Scroll fade animation
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

    // Profile menu toggle
    const profileMenuTrigger = document.getElementById('profileMenuTrigger');
    if (profileMenuTrigger) {
        profileMenuTrigger.addEventListener('click', function(event) {
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
    }

    // Color selection active state
const colorCircles = document.querySelectorAll(".color-circle");

colorCircles.forEach(circle => {
    circle.addEventListener("click", function () {
        // Remove 'selected' class from all circles
        colorCircles.forEach(c => c.classList.remove("selected"));

        // Add 'selected' to clicked circle
        this.classList.add("selected");

        // Update hidden input
        const selectedColorInput = document.getElementById("selectedColorInput");
        if (selectedColorInput) {
            selectedColorInput.value = this.dataset.color;
        }
    });
});


    // Add to cart form submission
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                const modalElement = document.getElementById('cartSuccessModal');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

                setTimeout(() => {
                    modal.hide();
                }, 2000);
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                const errorMessage = response.message || '❌ Failed to add to cart.';
                
                // Set the error message
                document.getElementById('errorMessage').textContent = errorMessage;
                
                // Show the error modal
                const failedModal = new bootstrap.Modal(document.getElementById('cartFailedModal'));
                failedModal.show();
                
                // Hide after 3 seconds
                setTimeout(() => {
                    failedModal.hide();
                }, 3000);
            }
        });
    });

    // Buy Now button event listener
    const buyNowBtn = document.getElementById('buyNowBtn');
    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Update the hidden quantity input
            document.getElementById('quantity_input').value = document.getElementById('quantity').value;
            
            // Create a new form element
            const tempForm = document.createElement('form');
            tempForm.action = "{{ route('checkout.direct') }}";
            tempForm.method = 'POST';
            tempForm.style.display = 'none';
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('input[name="_token"]').value;
            tempForm.appendChild(csrfToken);
            
            // Add product ID
            const productId = document.createElement('input');
            productId.type = 'hidden';
            productId.name = 'product_id';
            productId.value = "{{ $product->id }}";
            tempForm.appendChild(productId);
            
            // Add quantity
            const quantity = document.createElement('input');
            quantity.type = 'hidden';
            quantity.name = 'quantity';
            quantity.value = document.getElementById('quantity').value;
            tempForm.appendChild(quantity);
            
            // Add price
            const price = document.createElement('input');
            price.type = 'hidden';
            price.name = 'price';
            price.value = "{{ $product->price }}";
            tempForm.appendChild(price);
            
            // Add product name
            const productName = document.createElement('input');
            productName.type = 'hidden';
            productName.name = 'product_name';
            productName.value = "{{ $product->name }}";
            tempForm.appendChild(productName);
            
            // Add image
            const image = document.createElement('input');
            image.type = 'hidden';
            image.name = 'image';
            image.value = document.querySelector('input[name="image"]').value;
            tempForm.appendChild(image);
            const form = document.getElementById('productForm');
        form.action = "{{ route('checkout.direct') }}";
        form.submit();
    });

     
    }
});

// Global functions
function changeImage(thumbnail) {
    let mainImage = document.getElementById("mainImage");
    let imageInput = document.querySelector('input[name="image"]');
    mainImage.src = thumbnail.src;
    if (imageInput) {
        imageInput.value = thumbnail.src;
    }
}

function changeQuantity(amount) {
    const input = document.getElementById('quantity');
    const hiddenInput = document.getElementById('quantity_input');
    let current = parseInt(input.value);
    let max = parseInt(input.max);
    let newVal = current + amount;
    
    if (newVal >= 1 && newVal <= max) {
        input.value = newVal;
        hiddenInput.value = newVal;
        
        // Disable buttons if trying to exceed stock
        if (newVal > max) {
            disableButtons();
        } else {
            addToCartBtn.disabled = false;
            buyNowBtn.disabled = false;
            addToCartBtn.classList.remove('disabled');
            buyNowBtn.classList.remove('disabled');
        }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const stockCount = {{ $product->stock }};
    const addToCartBtn = document.getElementById('addToCartBtn');
    const buyNowBtn = document.getElementById('buyNowBtn');
    const quantityInput = document.getElementById('quantity');

    // Initial check
    if (stockCount <= 0) {
        disableButtons();
        showOutOfStockMessage();
    }

    function disableButtons() {
        addToCartBtn.disabled = true;
        buyNowBtn.disabled = true;
        addToCartBtn.classList.add('disabled');
        buyNowBtn.classList.add('disabled');
    }

    function showOutOfStockMessage() {
        const buttonContainer = document.querySelector('.button-container');
        buttonContainer.insertAdjacentHTML('afterend', `
            <div class="alert alert-danger mt-3" id="outOfStockAlert">
                This product is currently out of stock
            </div>
        `);
    }

    // Handle quantity changes
    quantityInput.addEventListener('change', function() {
        if (this.value > stockCount) {
            disableButtons();
        } else if (stockCount > 0) {
            addToCartBtn.disabled = false;
            buyNowBtn.disabled = false;
            addToCartBtn.classList.remove('disabled');
            buyNowBtn.classList.remove('disabled');
        }
    });

    function selectColor(element) {
    // Remove selected class from all colors
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.classList.remove('selected');
    });
    
    // Add selected class to clicked color
    element.classList.add('selected');
    
    // Update hidden input value
    document.getElementById('selectedColor').value = element.dataset.color;
}
});


</script>

@if(Auth::check())
    <x-notifications-modal 
        :notifications="$notifications"
        :unreadCount="$unreadCount" />
@endif

</body>
</html>
