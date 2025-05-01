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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
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

<!-- header section starts  -->
<header class="scroll-fade">
    <div class="header-container">
        <div class="purchase-section">
            <div class="back-arrow" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></div>
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
  </div>
  <div class="tab" data-status="cancelled">
    <div class="circle-tab">
      <div class="icon"><i class="fas fa-box-open"></i></div>
      <span>Cancelled</span>
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
    
    
<!-- Cancel Reason Modal -->
    <div class="modal fade" id="cancelReasonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Why do you want to cancel?</h5>
                </div>
                <div class="modal-body">
                    <div class="cancel-reason-options">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancel_reason" id="reason1" value="Need to change delivery address">
                            <label class="form-check-label" for="reason1">Need to change delivery address.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancel_reason" id="reason2" value="Placed the wrong item or quantity">
                            <label class="form-check-label" for="reason2">Placed the wrong item or quantity.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancel_reason" id="reason3" value="Discovered a cheaper or more suitable option elsewhere">
                            <label class="form-check-label" for="reason3">Discovered a cheaper or more suitable option elsewhere.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancel_reason" id="reason4" value="Selected the wrong size, color, or variant">
                            <label class="form-check-label" for="reason4">Selected the wrong size, color, or variant.</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="proceedToConfirm">Process</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Cancel Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Are you sure you want to cancel?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>

<!-- Cancel Success Modal -->
<div class="modal fade" id="cancelSuccessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal text-center p-4">
      <div class="checkmark-wrapper mx-auto mb-3">
        <i class="bi bi-check-lg check-icon"></i>
      </div>
      <p class="modal-text">Your order has been cancelled successfully</p>
    </div>
  </div>
</div>


<div class="purchase-see-more-container">
    <button class="purchase-see-more-btn" id="shopMoreBtn">Shop more</button>
</div>


<!-- Rating Modal -->
<div class="rating-modal" id="ratingModal">
    <div class="rating-modal-content">
        <button class="close-modal" id="closeModal">&times;</button>
        <div class="rating-modal-header">
            <h2>Rate Product</h2>
        </div>
        
        <div class="rating-product-info">
            <h3>Mini Fuzzy Flower</h3>
            <p>Adorable mini fuzzy flowers, perfect for adding a soft, handmade touch to your space!</p>
            <p class="variation">Variation: Pink</p>
        </div>
        
        <hr class="rating-divider">
        
        <div class="rating-section">
            <h4>Product Quality</h4>
            <table class="rating-table">
                <tr>
                    <th>Appearance:</th>
                    <td><textarea placeholder="Write about this Aspect"></textarea></td>
                </tr>
                <tr>
                    <th>Material Quality:</th>
                    <td><textarea placeholder="Write about this Aspect"></textarea></td>
                </tr>
            </table>
            
            <div class="rating-options">
                <label>
                    <input type="checkbox"> Show username on your review
                </label>
                <label>
                    <input type="checkbox"> Add Photo
                </label>
                <label>
                    <input type="checkbox"> Add Video
                </label>
            </div>
        </div>
        
        <hr class="rating-divider">
        
        <div class="rating-section">
            <h4>About Service</h4>
            <div class="rating-options">
                <label>
                    <input type="checkbox"> Seller Service
                </label>
                <label>
                    <input type="checkbox"> Delivery Service
                </label>
            </div>
        </div>
        
        <div class="rating-modal-footer">
            <button class="rating-cancel">Cancel</button>
            <button class="rating-confirm">Confirm</button>
        </div>
    </div>
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
    <div class="footer-bottom"></div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>

document.getElementById('shopMoreBtn').addEventListener('click', function() {
    window.location.href = '{{ route("shop.index") }}';
});

document.addEventListener("DOMContentLoaded", function () {

    // Initialize variables
    let currentOrderId = null;
    let cancelReason = null;
    
    // Initialize modals
    const cancelReasonModal = new bootstrap.Modal(document.getElementById('cancelReasonModal'));
    const confirmCancelModal = new bootstrap.Modal(document.getElementById('confirmCancelModal'));
    const cancelSuccessModal = new bootstrap.Modal(document.getElementById('cancelSuccessModal'));
    
    // Scroll Fade Animation
    const scrollElements = document.querySelectorAll(".scroll-fade");
    const scrollObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                entry.target.classList.toggle("show", entry.isIntersecting);
            });
        },
        { threshold: 0.2 }
    );
    scrollElements.forEach((el) => scrollObserver.observe(el));

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

    // Cancel Order Flow
    document.querySelectorAll('.cancel-order').forEach(button => {
        button.addEventListener('click', function() {
            const orderBox = this.closest('.order-box');
            currentOrderId = orderBox.getAttribute('data-order-id');
            cancelReasonModal.show();
        });
    });
    
    // Proceed to confirmation after selecting reason
    document.getElementById('proceedToConfirm')?.addEventListener('click', function() {
        const selectedReason = document.querySelector('input[name="cancel_reason"]:checked');
        if (selectedReason) {
            cancelReason = selectedReason.value;
            cancelReasonModal.hide();
            confirmCancelModal.show();
        } else {
            alert('Please select a reason for cancellation.');
        }
    });
    
    // Handle final confirmation
    document.getElementById('confirmCancelBtn')?.addEventListener('click', function() {
        if (!currentOrderId || !cancelReason) return;
        
        fetch("{{ route('orders.cancel') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                order_id: currentOrderId,
                reason: cancelReason 
            })
        })
        .then(response => response.json())
        .then(data => {
            confirmCancelModal.hide();
            cancelSuccessModal.show();
            
            // Auto-close the success modal after 2 seconds
            setTimeout(() => {
                cancelSuccessModal.hide();
                location.reload();
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            confirmCancelModal.hide();
            alert('Failed to cancel order. Please try again.');
        });
    });
});

// Rating Modal Handling
const ratingModal = document.getElementById('ratingModal');
const closeModalBtn = document.getElementById('closeModal');
const ratingCancelBtn = document.querySelector('.rating-cancel');

// Function to show rating modal
function showRatingModal() {
    ratingModal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
}

// Function to hide rating modal
function hideRatingModal() {
    ratingModal.style.display = 'none';
    document.body.style.overflow = ''; // Re-enable scrolling
}
            
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

// Event listeners for closing the modal
closeModalBtn.addEventListener('click', hideRatingModal);
ratingCancelBtn.addEventListener('click', hideRatingModal);

// Close modal when clicking outside the modal content
ratingModal.addEventListener('click', function(e) {
    if (e.target === ratingModal) {
        hideRatingModal();
    }
});

// Connect "Rate Seller" buttons to the modal
document.querySelectorAll('.rate-seller').forEach(button => {
    button.addEventListener('click', function() {
        // Here you could add logic to populate the modal with order-specific data
        showRatingModal();
    });
});

// Confirm button functionality (you can add your submission logic here)
document.querySelector('.rating-confirm').addEventListener('click', function() {
    // Add your rating submission logic here
    alert('Rating submitted!'); // Placeholder - replace with actual submission code
    hideRatingModal();
});
</script>
</body>
</html>