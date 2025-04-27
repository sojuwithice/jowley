<!DOCTYPE html>
<html>
<head>
    <title>Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/purchasepage.css') }}">
</head>
<body>
<div class="top-header scroll-fade">
    <div class="left">
        <a href="#" class="logo">Jowley's Craft</a>
    </div>

    <div class="right">
    @guest
        <a href="{{ url('/Register') }}" class="signup">Sign Up</a>
        <a href="{{ route('LoginSignUp') }}" class="login">Log in</a>
    @else
        <!-- Notifications and Profile Menu for logged-in users -->
        <a href="#" class="notification">
            <i class="fas fa-bell"></i> Notification
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
</body>
</html>

<!-- header section starts  -->
 
<header class="scroll-fade">
  <div class="header-container">
  
    <div class="purchase-section">
      <div class="back-arrow"><i class="onclick="window.history.back();"></i></div>
      <h2>My Purchases</h2>
    </div>

    <div class="header-right">
      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="icons">
        <a href="{{ route('cart') }}" class="fas fa-shopping-cart cart-icon-link">
          <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </a>
      </div>
    </div>

  </div>
</header>

<!-- order status -->

<div class="order-status-tabs">
  <div class="tab active" data-status="all">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-box"></i></div>
      <span>All</span>
    </div>
  </div>
  <div class="tab" data-status="to-pay">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-coins"></i></div>
      <span>To Pay</span>
    </div>
  </div>
  <div class="tab" data-status="to-ship">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-wallet"></i></div>
      <span>To Ship</span>
    </div>
  </div>
  <div class="tab" data-status="to-receive">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-truck"></i></div>
      <span>To Receive</span>
    </div>
  </div>
  
  <div class="tab" data-status="cancelled">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-box-open"></i></div>
      <span>Cancelled</span>
    </div>
  </div>
</div>


    <!-- order cards -->
    <section class="order-wrapper">
    @foreach($orders as $order)
    <div class="order-box">
        <div class="order-status">
            <span class="status-info">{{ $order->status }}</span>
            <span class="to-pay">| To Pay</span>
        </div>

        @foreach($order->orderItems as $orderItem)
            <div class="order-main">
                <div class="product-image">
                @php
        $defaultImage = 'default.jpg';
        $rawImages = $orderItem->product->images;

        // Decoding the images if it's a JSON string
        $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;

        // Get the first image, or default if none exist
        $imageFilename = $images[0] ?? $defaultImage;

        // Ensure correct path format (forward slashes)
        $imageFilename = str_replace('\\', '/', $imageFilename);

        // Build the final path to the image
        $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
    @endphp

    <!-- Display the image with alt text as the product name -->
    <img src="{{ asset($finalPath) }}" alt="{{ $orderItem->product->name }}" width="100">
                </div>
                <div class="product-info">
                    <h3>{{ $orderItem->product->name }}</h3>
                    <p class="desc">{{ $orderItem->product->description }}</p>
                    <p class="variation">Variation: {{ $orderItem->color }}</p>
                </div>
                <div class="product-price">₱{{ number_format($orderItem->price, 2) }}</div>
            </div>
        @endforeach
            </div>

            <div class="order-subinfo">
                <span>Order Received on {{ $order->created_at->format('m/d/Y') }}</span>
                <span>Item(s): {{ $order->orderItems->count() }}</span>
            </div>

            <div class="order-footer">
                <div class="footer-left">
                <span>Order Total: <span class="price">₱{{ number_format($order->total_amount, 2) }}</span></span>
                </div>
                <div class="footer-right">
                    <button class="buy-again">Buy Again</button>
                    <button class="view-rating">View Shop Rating</button>
                </div>
            </div>
        </div>
        @endforeach
    </section>

<div class="purchase-see-more-container scroll-fade">
    <a href="{{ route('shop') }}">
        <button class="purchase-see-more-btn" id="shopMoreBtn">Shop more</button>
    </a>
</div>



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
  </div>

  <div class="footer-bottom"></div>

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
        }, 3000); 
    });


    

  const tabs = document.querySelectorAll('.order-status-tabs .tab');
  const orders = document.querySelectorAll('.order-box');

  const statusButtons = {
    'to-pay': ['Cancel Order'],
    'to-ship': ['Contact Seller'],
    'to-receive': ['Contact Seller'],
    'completed': ['Buy Again', 'View Shop Rating'],
    'cancelled': ['Cancellation Details', 'Buy Again'],
  };

  const statusInfo = {
    'to-pay': {
      orderStatus: "Order Placed",
      orderSubinfo: "Ship within a day",
    },
    'to-ship': {
      orderStatus: "Waiting for Courier",
      orderSubinfo: "Ship within a day",
    },
    'to-receive': {
      orderStatus: "In Transit",
      orderSubinfo: "Arriving Today",
    },
    'completed': {
      orderStatus: "Parcel Delivered",
      orderSubinfo: "Completed",
    },
    'cancelled': {
      orderStatus: "Order Cancelled",
      orderSubinfo: "Cancelled by Seller",
    },
  };

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const selectedStatus = tab.getAttribute('data-status') || 'to-pay';

      orders.forEach(order => {
        const orderStatus = order.getAttribute('data-status');
        const showOrder = selectedStatus === 'to-pay' || selectedStatus === orderStatus;

        order.style.display = showOrder ? 'block' : 'none';

        if (showOrder) {
          const footerRight = order.querySelector('.footer-right');
          footerRight.innerHTML = '';
          (statusButtons[orderStatus] || []).forEach(text => {
            const btn = document.createElement('button');
            btn.textContent = text;
            footerRight.appendChild(btn);
          });

         
          const statusSpans = order.querySelectorAll('.order-status span');
          const subinfoSpans = order.querySelectorAll('.order-subinfo span');

          if (statusSpans.length > 0) {
            statusSpans[0].textContent = statusInfo[orderStatus]?.orderStatus || 'Status';
          }

          if (subinfoSpans.length > 0) {
            subinfoSpans[0].textContent = statusInfo[orderStatus]?.orderSubinfo || '';
          }

          
          if (statusSpans.length > 1) {
            statusSpans[1].style.display = selectedStatus === 'all' ? 'inline' : 'none';
          }
        }
      });
    });
  });
  document.querySelector('.tab[data-status="to-pay"]').click();






</script>

</body>
</html>
