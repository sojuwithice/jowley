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
            @if(Auth::check())
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
            </div>
        </div>
    </header>

    <div class="container custom-container mt-4">
        <!-- Products Ordered -->
        <h4 class="fw-bold">Products Ordered</h4>

        <!-- Delivery Address -->
        <div class="card p-3 mb-3">
            <h5 class="section-title">Delivery Address</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    @php
                        $defaultAddress = Auth::user()->addresses()->where('is_default', 1)->first();
                    @endphp
                    @if($defaultAddress)
                    <strong>{{ $defaultAddress->full_name }}</strong><br>
                    <span>{{ $defaultAddress->phone_number }}</span><br>
                    <span>{{ $defaultAddress->street }}<br>
                        {{ $defaultAddress->barangay }}, {{ $defaultAddress->city }}, {{ $defaultAddress->province }}</span><br>
                    @else
                    <small class="text-danger">
                        No address found. <a href="#" class="text-decoration-underline">Go to profile to add</a>
                    </small>
                    @endif
                </div>
                <button class="btn btn-pink">Change</button>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card p-3 mb-3">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Variation</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Item Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td> @php
                            $defaultImage = 'default.jpg';
                            $rawImages = $item->product->images;

                            $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;

                            $imageFilename = $images[0] ?? $defaultImage;

                            $imageFilename = str_replace('\\', '/', $imageFilename);

                            $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;

                        @endphp

                        <img src="{{ asset($finalPath) }}" alt="{{ $item->product->name }}" width="100"></td>
                        <td>
                            <strong>{{ $item->product->name }}</strong><br>
                            <small>{{ $item->product->description }}</small>
                        </td>
                        <td>{{ $item->variation ? 'Variation: ' . $item->variation : 'No Variation' }}</td>
                        <td>₱{{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end fw-bold">
                Total Order ({{ count($cartItems) }} items): ₱{{ number_format($totalPrice, 2) }}
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="card p-3">
            <h5 class="section-title">Payment Methods</h5>
            <div class="d-flex justify-content-end gap-3">
                <button class="btn btn-pink payment-method" id="cash-on-delivery">Cash on Delivery</button>
                <button class="btn btn-pink payment-method" id="gcash-method">
                    <img src="/image/gcash.png" alt="GCash" style="width: 20px; height: 20px; margin-right: 8px;"> Gcash
                </button>
            </div>
            <hr>
            <div>
                <p>Merchandise Subtotal: <span class="float-end">₱{{ number_format($subtotal, 2) }}</span></p>
                <p class="fw-bold">Total Payment: <span class="float-end">₱{{ number_format($totalPrice, 2) }}</span></p>
            </div>
        </div>

        <!-- Place Order Button -->
        <form id="placeOrderForm" method="POST" action="{{ route('placeOrder') }}">
    @csrf
    <input type="hidden" name="payment_method" id="paymentMethodInput">
    <input type="hidden" name="total_amount" value="{{ $totalPrice }}">
    
    @foreach($cartItems as $item)
        <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
    @endforeach
    
    <div class="d-flex justify-content-end mt-3">
        <button type="submit" class="btn btn-pink">Place Order</button>
    </div>
</form>



        <!-- Modal for Payment Method -->
        <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="margin-left: 15px; margin-right: 15px;">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #ec32b5;">Please Choose a Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>You must select a payment method before placing your order.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- Receipt Confirmation Modal for GCash -->
<div class="modal fade gcash-modal" id="gcashReceiptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="/image/gcash.png" alt="GCash Logo">
                        Complete Your Payment
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <div class="order-info">
                        <h5 class="mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between">
                            <span>Date:</span>
                            <strong>{{ now()->format('M d, Y h:i A') }}</strong>
                        </div>
                    </div>
                    
                    <h6>Products:</h6>
                    @foreach($cartItems as $item)
                    <div class="product-item-gcash">
                        @php
                            $defaultImage = 'default.jpg';
                            $rawImages = $item->product->images;
                            $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
                            $imageFilename = $images[0] ?? $defaultImage;
                            $imageFilename = str_replace('\\', '/', $imageFilename);
                            $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
                        @endphp
                        <img src="{{ asset($finalPath) }}" alt="{{ $item->product->name }}">
                        <div class="product-info-gcash">
                            <strong>{{ $item->product->name }}</strong>
                            <div class="d-flex justify-content-between">
                                <small>x{{ $item->quantity }}</small>
                                <span>₱{{ number_format($item->product->price) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="amount-display mt-3">
                        <div class="amount-label">Total Amount to Pay</div>
                        <div class="amount-value">₱{{ number_format($totalPrice, 2) }}</div>
                    </div>
                  
                  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-pink" id="confirmGcashPayment">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>

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
    document.addEventListener("DOMContentLoaded", function () {
    const paymentButtons = document.querySelectorAll('.payment-method');
    const form = document.getElementById('placeOrderForm');
    const paymentMethodInput = document.getElementById('paymentMethodInput');
    const totalAmountInput = document.getElementById('totalAmountInput');
    let selectedPaymentMethod = null;

    // Select Payment Method
    paymentButtons.forEach(button => {
        button.addEventListener('click', function () {
            paymentButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            selectedPaymentMethod = this.id;
            paymentMethodInput.value = this.id === 'gcash-method' ? 'GCash' : 'Cash on Delivery';
        });
    });

    // Handle Form Submit
    form.addEventListener('submit', function (e) {
        if (!selectedPaymentMethod) {
            e.preventDefault();
            new bootstrap.Modal(document.getElementById('paymentMethodModal')).show();
        } else if (selectedPaymentMethod === 'gcash-method') {
            e.preventDefault();
            new bootstrap.Modal(document.getElementById('gcashReceiptModal')).show();
        }
    });

    // Handle Confirm GCash Payment
    document.getElementById('confirmGcashPayment').addEventListener('click', function () {
        form.submit(); // Now safely submit the form
    });
});

    </script>
</body>

</html>