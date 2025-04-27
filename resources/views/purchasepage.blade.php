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
                <li><a href="#">My Profile</a></li>
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
    <div class="back-arrow" onclick="window.history.back();">
    <i class="fas fa-arrow-left"></i>
</div>

      <h2>My Purchases</h2>
    </div>

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
    </div>

  </div>
</header>

<!-- notif modal -->
@auth
    <x-notifications-modal 
        :notifications="auth()->user()->notifications"
        :unreadCount="auth()->user()->unreadNotifications->count()" />
@else
    <x-notifications-modal :notifications="[]" :unreadCount="0" />
@endauth

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
  <div class="tab" data-status="completed">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-shopping-bag"></i></div>
      <span>Completed</span>
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

  <!-- Order 1 -->
  <div class="order-box" data-status="completed">
    <div class="order-status">
    <span class="status-info">Waiting for Courier</span>
      <span class="completed"> | Completed</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

  <!-- Order 2 -->
  <div class="order-box" data-status="to-pay">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="to-pay">| To Pay</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

  <div class="order-box" data-status="to-ship">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="to-ship">| To Ship</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>


  <div class="order-box" data-status="to-receive">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="to-receive">| To Receive</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

  <div class="order-box" data-status="completed">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="completed">| Completed</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

  <div class="order-box" data-status="cancelled">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="cancelled">| Cancelled</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

  <div class="order-box" data-status="completed">
    <div class="order-status">
    <span class="status-info">Parcel has been delivered</span>
      <span class="completed">| Completed</span>
    </div>

    <div class="order-main">
      <div class="product-image">
        <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
      </div>
      <div class="product-info">
        <h3>Mini Fuzzy Flower</h3>
        <p class="desc">Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
        <p class="variation">Variation: Pink</p>
      </div>
      <div class="product-price">₱40.00</div>
    </div>

    <div class="order-subinfo">
      <span>Order Received on 02/01/2025</span>
      <span>Item(s): 1</span>
    </div>

    <div class="order-footer">
      <div class="footer-left">
        <span>Order Total: <span class="price">₱40.00</span></span>
        <span>Date Received: 03/1/2025</span>
        <span>Time: 12:00 PM</span>
      </div>
      <div class="footer-right">
        <button class="buy-again">Buy Again</button>
        <button class="view-rating">View Shop Rating</button>
      </div>
    </div>
  </div>

</section>

<div class="purchase-see-more-container scroll-fade">
<a href="{{ route('shop.index') }}">Shop</a>
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
      orderStatus: "Waiting for Courier",
      orderSubinfo: "Ship within a day",
    },
    'to-ship': {
      orderStatus: "Waiting for Shipment",
      orderSubinfo: "Ship within a day",
    },
    'to-receive': {
      orderStatus: "Out for Delivery",
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

      const selectedStatus = tab.getAttribute('data-status') || 'all';

      orders.forEach(order => {
        const orderStatus = order.getAttribute('data-status');
        const showOrder = selectedStatus === 'all' || selectedStatus === orderStatus;

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

  document.querySelector('.tab[data-status="all"]').click();

 // profile menu//
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

  /* notif modal js*/
  document.getElementById('notificationButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('notificationModal').style.display = 'block';
        });



















  
</script>