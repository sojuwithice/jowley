<!DOCTYPE html>
<html>
<head>

    <title>Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">


</head>
<body>
<div class="top-header scroll-fade">
    <div class="left">
        <a href="#" class="logo">Jowley's Craft</a>
    </div>

    <div class="right">
        <a href="#" class="notification">
            <i class="fas fa-bell"></i> Notification
        </a>
        <a href="#" class="user-profile">
            <i class="fas fa-user"></i> AkosiMJ#01
        </a>
    </div>
</div>
</body>
</html>

<!-- header section starts  -->
<header class="scroll-fade">
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#products">Products</a>
    </nav>

    <div class="header-right"> 
    <form action="{{ route('shop.index') }}" method="GET" class="search-bar">
        <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>

        <div class="icons">
            <a href="{{ route('cart') }}" class="fas fa-shopping-cart cart-icon-link">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</header>




<!-- {Product} -->
<section class="daily-container scroll-fade">
    
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5 scroll-fade">
    @forelse ($products as $product)
        <div class="col">
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                
                <p class="product-text">{{ $product->name }}</p>

                <div class="product-name-daily">
                    <div class="heart-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $product->rating)
                                <i class="fa-solid fa-heart text-warning fs-5" data-value="{{ $i }}"></i>
                            @else
                                <i class="fa-regular fa-heart text-warning fs-5" data-value="{{ $i }}"></i>
                            @endif
                        @endfor
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱{{ number_format($product->price, 2) }}</span>
                    <span class="sold-count">{{ $product->sold_count }} sold</span>
                </div>

                <div class="view-details">
                    <a href="{{ route('product.show', $product->id) }}" class="btn-details">View Details</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">No products found.</p>
    @endforelse
</div>


        

    

   <!-- footer section starts-->
   <footer class="footer-wrapper">
    <div class="footer-line"></div>

    <section class="footer-section"> 
        <div class="footer-content-container">
            <div class="footer-column">
                <h4>Customer Care</h4>
                <ul>
                    <li>Help Center</li>
                    <li>How to Buy</li>
                    <li>Shipping and Delivery</li>
                    <li>How to Return</li>
                    <li>Question?</li>
                    <li>Contact Us</li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Jowley's Crafts</h4>
                <ul>
                    <li>About Jowley's Crafts</li>
                    <li>Terms and Conditions</li>
                    <li>Privacy Policy</li>
                    <li>Intellectual Property Protection</li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Payment Methods</h4>
                <div class="payment-methods">
                    <img src="{{ asset('image/gcash.jpg') }}" alt="GCash">
                    <img src="{{ asset('image/cod.jpg') }}" alt="Cash on Delivery">
                </div>
            </div>

            <div class="footer-column">
                <h4>Delivery Services</h4>
                <img src="{{ asset('image/jnt.jpg') }}" alt="J&T Express">
            </div>
        </div>

        <div class="footer-bottom"></div>
    </section>
</footer>

    

    
















    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const scrollElements = document.querySelectorAll(".scroll-fade");

        const scrollObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                    } else {
                        entry.target.classList.remove("show"); 
                    }
                });
            },
            { threshold: 0.2 }
        );

        scrollElements.forEach((el) => scrollObserver.observe(el));
    });

    document.addEventListener("DOMContentLoaded", function () {
    const cartLink = document.querySelector('.cart-icon-link');
    if (cartLink) {
        cartLink.addEventListener('click', function (e) {
            const spinner = this.querySelector('.spinner-border');
            spinner.classList.remove('d-none');
            this.classList.add('disabled');
            
            setTimeout(() => {
                this.classList.remove('disabled');
                spinner.classList.add('d-none');
            }, 3000);
        });
    }
});

</script>