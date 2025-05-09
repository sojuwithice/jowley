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

@include('components.notifications-modal')
<!-- top header bar starts-->
<!-- Top Header -->
<div class="top-header scroll-fade">
    <div class="left">
        <a href="#" class="logo">Jowley's Craft</a>
    </div>

    <div class="right">
    @guest
        <a href="{{ url('/Register') }}" class="signup">Sign Up</a>
        <a href="{{ route('LoginSignUp') }}" class="login">Log in</a>
    @else
        
        <a href="#" class="notification" id="notificationButton">
            <i class="fas fa-bell"></i> Notification
            @if ($unreadCount > 0)
            <span class="notification-badge" id="notificationBadge">{{ $unreadCount }}</span>
        @else
            <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
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
    @endguest
</div>

    </div>
</div>

<!-- header section starts  -->
<header class="scroll-fade">
    <nav class="navbar">
        <a href="{{ route('homepage') }}">Home</a>
        <a href="{{ route('shop.index') }}">Products</a>
        <a href="{{ route('faqs') }}">FAQs</a>
    </nav>

    
    <div class="header-right"> 
    <form action="{{ route('shop.index') }}" method="GET" class="search-bar">
    <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="icons">
        <a href="{{ route('cart') }}" class="fas fa-shopping-cart cart-icon-link">
            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </a>
    </div>
</header>

@auth
    <x-notifications-modal 
        :notifications="auth()->user()->notifications"
        :unreadCount="auth()->user()->unreadNotifications->count()" />
@else
    <x-notifications-modal :notifications="[]" :unreadCount="0" />
@endauth


<!-- header section ends -->

<!-- home section starts -->

<section class="home scroll-fade" id="home">

    <div class="content">
        <h3>Handmade with love, crafted for you. </h3>
        <p>Discover handmade products crafted to match your unique taste.<br>
        Find the perfect DIY creations you've been searching for, made with love and attention to detail!</p>
    </div>

    <div class="absolute inset-0 justify-center">
        <div class="bg-shape1 bg-pink opacity-50 bg-blur"></div>
        <div class="bg-shape2 bg-primary opacity-50 bg-blur"></div>
    </div>


    <div class="img-wrapper">
    <div style="background-image: url('{{ asset('image/tulip-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/lily-keychain.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/fuzzy-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/butterfly-bouquet.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/glower.jpg') }}');"></div>
    </div>

</section>

<!-- home section ends -->

<!-- new arrival -->

<section class="new-arrival scroll-fade" id="new-arrival">
    <h2>New Arrivals</h2>
    <div class="new-product-container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img src="{{ asset('image/coin-purse.png') }}" class="img" alt="Coin Purse">
                    <div class="content">
                        <h2>New Crafted Items!</h2>
                        <p class="description">We have a new product for you.</p>
                        <p class="see">See more details:</p>
                        <a href="#" class="btn btn-primary">Coin Purse</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img src="{{ asset('image/hair-clips.png') }}" class="img" alt="Crocheted Hair Clips">
                    <div class="content">
                        <h2>New Crafted Items!</h2>
                        <p class="description">We have a new product for you.</p>
                        <p class="see">See more details:</p>
                        <a href="#" class="btn btn-primary">Crocheted Hair Clips</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- catgories -->

<section class="categories scroll-fade">
    <h2>Find Things You’ll Love</h2>
    <div class="category-container scroll-fade">
        <div class="category">
            <div class="circle">
             <img src="{{ asset('image/categ-bracelet.png') }}" alt="Bracelet">
            </div>
            <span>Bracelet</span>
        </div>
        <div class="category"> 
            <div class="circle">
             <img src="{{ asset('image/categ-keychain.png') }}" alt="Keychain">
            </div>    
            <span>Keychain</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/categ-bouquet.png') }}" alt="Bouquet">
            </div>
            <span>Bouquet</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/hair-accessories.png') }}" alt="Hair Accessories">
            </div>
                <span>Hair Accessories</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/clothes.png') }}" alt="Clothes">
            </div>
                <span>Clothes</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/wallet.png') }}" alt="Wallet">
            </div>
                <span>Wallet</span>
        </div>
    </div>
</section>

<!-- banner -->
<section class="banner scroll-fade">
        <img src="{{ asset('image/banner.jpg') }}" alt="Handmade Crafts">
        <div class="overlay">
            <h3>Cute Styles</h3>
            <h2>The Perfect Craft for You</h2>
        </div>
    </section>


<!-- featured products-->

<section class="featured scroll-fade">
    <div class="container my-5 text-center scroll-fade">
        <h2 class="text-center mb-4">Our Featured Products</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">
            <div class="col">
            <a href="{{ route('product.show', ['slug' => 'minifuzzy']) }}">
                    <div class="product-card">
                        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                        <p class="top-rank">Top <span>1</span></p>
                        <p class="product-name fw-bold">Mini Fuzzy Flower</p>
                        <div class="sales-info">Monthly Sales 90</div>
                    </div>
                </a>
            </div>

            <div class="col">
            <a href="{{ route('product.show', ['slug' => 'fuzzy-lily']) }}">
                    <div class="product-card">
                        <img src="{{ asset('image/fuzzy-flower.jpg') }}" alt="Fuzzy Lily Flower Bouquet" class="product-img">
                        <p class="top-rank">Top <span>2</span></p>
                        <p class="product-name fw-bold">Fuzzy Lily Flower Bouquet</p>
                        <div class="sales-info">Monthly Sales 80</div>
                    </div>
                </a>
            </div>

            <div class="col">
            <a href="{{ route('product.show', ['slug' => 'single-tulip']) }}">
                    <div class="product-card">
                        <img src="{{ asset('image/single-tulip.jpg') }}" alt="Single Tulip Crochet Bouquet" class="product-img">
                        <p class="top-rank">Top <span>3</span></p>
                        <p class="product-name fw-bold">Single Tulip Crochet Bouquet</p>
                        <div class="sales-info">Monthly Sales 80</div>
                    </div>
                </a>
            </div>

            <div class="col">
            <a href="{{ route('product.show', ['slug' => 'butterfly-bouquet']) }}">
                    <div class="product-card">
                        <img src="{{ asset('image/butterfly-bouquet.jpg') }}" alt="Butterfly Bouquet" class="product-img">
                        <p class="top-rank">Top <span>4</span></p>
                        <p class="product-name fw-bold">Butterfly Bouquet</p>
                        <div class="sales-info">Monthly Sales 80</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>



</section>





</section>

 <!-- Daily Discoveries Section -->
<section class="daily-container scroll-fade">
    <div class="daily-wrapper">
        <div class="line"></div>
        <h2 class="title">Daily Discoveries</h2>
        <div class="line"></div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5 scroll-fade">
        
        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                    <p class="product-text">Mini Fuzzy Flower</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱55</span>
                    <span class="sold-count">20 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'minifuzzy']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/baby-mushroom.jpg') }}" alt="Baby Mushroom" class="product-img">
                <p class="product-text">Cute Baby Mushroom</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱55</span>
                    <span class="sold-count">20 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'baby-mushroom']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/crochet-top.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Handmade Crochet Top</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱300</span>
                    <span class="sold-count">3 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'crochet-top']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/single-tulip.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Single Tulip Crochet Bouquet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱130</span>
                    <span class="sold-count">140 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'single-tulip']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/sunflower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Crochet Sunflower Bouquet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱160</span>
                    <span class="sold-count">5 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'sunflower']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/earrings.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Tulip Earrings</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱40</span>
                    <span class="sold-count">50 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'earrings']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/headband.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Tulip Headband</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱90</span>
                    <span class="sold-count">10 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'headband']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/daisy-bracelet.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Daisy Bracelet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱49</span>
                    <span class="sold-count">87 sold</span>
                </div>

                <div class="view-details">
                <a href="{{ route('product.show', ['slug' => 'daisybracelet']) }}" class="btn-details">
        View Details
    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="daily-see-more-container scroll-fade">
    <a href="{{ route('shop.index') }}" class="daily-see-more-btn" id="seeMoreBtn">See More</a>

</div>
    </section>


    <!-- footer section starts-->
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
        <div class="footer-bottom"></div>
    </div>

    
</section>


</section>













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

    document.querySelector('.cart-icon-link').addEventListener('click', function (e) {
        const spinner = this.querySelector('.spinner-border');

        
        spinner.classList.remove('d-none');
        this.classList.add('disabled');

        
        setTimeout(() => {
            this.classList.remove('disabled');
            spinner.classList.add('d-none');
        }, 3000); // Simulate 3 seconds for demo purposes
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

    document.getElementById('notificationButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('notificationModal').style.display = 'block';
        });

</script>