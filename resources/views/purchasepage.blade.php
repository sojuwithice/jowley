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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <div class="back-arrow"><i class="onclick= "window.history.back();"></i></div>
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



<!-- order status tabs -->
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
    <div class="order-box" data-order-id="{{ $order->id }}" data-status="{{ str_replace(' ', '-', $order->status) }}">
        <div class="order-status">
            <span class="status-info">{{ ucfirst($order->status) }}</span>
            @if($order->status == 'to pay')
            <span class="to-pay">| To Pay</span>
            @endif
        </div>

        @foreach($order->orderItems as $orderItem)
            <div class="order-main">
                <div class="product-image">
                    @php
                        $defaultImage = 'default.jpg';
                        $rawImages = $orderItem->product->images;
                        $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
                        $imageFilename = $images[0] ?? $defaultImage;
                        $imageFilename = str_replace('\\', '/', $imageFilename);
                        $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
                    @endphp
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

        <div class="order-subinfo">
            <span>Order Placed on {{ $order->created_at->format('m/d/Y') }}</span>
            <span>Item(s): {{ $order->orderItems->sum('quantity') }}</span>
        </div>

        <div class="order-footer">
            <div class="footer-left">
                <span>Order Total: <span class="price">₱{{ number_format($order->total_amount, 2) }}</span></span>
            </div>
            <div class="footer-right">
                @if($order->status == 'to pay')
                <form action="{{ route('cancelOrder', $order->id) }}" method="POST" class="cancel-form">
                    @csrf
                    <button type="submit" class="cancel-btn">Cancel Order</button>
                </form>
                @elseif($order->status == 'to ship' || $order->status == 'to receive')
                <button class="contact-btn">Contact Seller</button>
                @elseif($order->status == 'completed')
                <button class="buy-again-btn">Buy Again</button>
                @elseif($order->status == 'cancelled')
                <button class="details-btn">Cancellation Details</button>
                <button class="buy-again-btn">Buy Again</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</section>

<!-- Your existing footer and see more button code remains the same -->

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


document.addEventListener("DOMContentLoaded", function () {
    // Initialize tab functionality
    const tabs = document.querySelectorAll('.order-status-tabs .tab');
    const orders = document.querySelectorAll('.order-box');
    
    // Function to filter orders by status
    function filterOrders(status) {
        orders.forEach(order => {
            const orderStatus = order.getAttribute('data-status');
            if (status === 'all' || orderStatus === status) {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    }
    
    // Tab click event
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const status = tab.getAttribute('data-status');
            filterOrders(status);
        });
    });
    
    // Initialize with "All" tab selected
    document.querySelector('.tab[data-status="all"]').click();
    
    // Handle cancel order
    document.querySelectorAll('.cancel-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const orderBox = this.closest('.order-box');
            const orderId = orderBox.dataset.orderId;
            
            if (confirm('Are you sure you want to cancel this order?')) {
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'POST' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the order status in the UI
                        orderBox.setAttribute('data-status', 'cancelled');
                        orderBox.querySelector('.status-info').textContent = 'Cancelled';
                        
                        // Remove the "To Pay" text if it exists
                        const toPaySpan = orderBox.querySelector('.to-pay');
                        if (toPaySpan) toPaySpan.remove();
                        
                        // Update the buttons
                        const footerRight = orderBox.querySelector('.footer-right');
                        footerRight.innerHTML = `
                            <button class="details-btn">Cancellation Details</button>
                            <button class="buy-again-btn">Buy Again</button>
                        `;
                        
                        // Re-filter to show the order in the correct tab
                        const currentTab = document.querySelector('.order-status-tabs .tab.active');
                        const currentStatus = currentTab.getAttribute('data-status');
                        filterOrders(currentStatus);
                    } else {
                        alert('Failed to cancel order: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while cancelling the order');
                });
            }
        });
    });
    
    // Simulate status change for demo purposes (remove in production)
    // This would normally happen via admin action or webhook
    function simulateStatusChange(orderId, newStatus) {
        const orderBox = document.querySelector(`.order-box[data-order-id="${orderId}"]`);
        if (orderBox) {
            orderBox.setAttribute('data-status', newStatus);
            orderBox.querySelector('.status-info').textContent = newStatus.split('-').map(word => 
                word.charAt(0).toUpperCase() + word.slice(1)
            ).join(' ');
            
            // Update buttons based on new status
            const footerRight = orderBox.querySelector('.footer-right');
            if (newStatus === 'to-ship') {
                footerRight.innerHTML = '<button class="contact-btn">Contact Seller</button>';
                // Remove "To Pay" text if it exists
                const toPaySpan = orderBox.querySelector('.to-pay');
                if (toPaySpan) toPaySpan.remove();
            }
            
            // Re-filter to show the order in the correct tab
            const currentTab = document.querySelector('.order-status-tabs .tab.active');
            const currentStatus = currentTab.getAttribute('data-status');
            filterOrders(currentStatus);
        }
    }
    
    // For demo: simulate an order moving to "to-ship" after 5 seconds
    // setTimeout(() => simulateStatusChange('1', 'to-ship'), 5000);
});

document.getElementById('profileMenuTrigger').addEventListener('click', function (event) {
        event.preventDefault();
        const profileMenu = document.getElementById('profileMenu');
        profileMenu.style.display = (profileMenu.style.display === 'block') ? 'none' : 'block';
    });

    window.addEventListener('click', function (event) {
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
</body>
</html>