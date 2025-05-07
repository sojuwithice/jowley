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
            <span class="to-pay"></span>
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
                <button class="rate-product-btn buy-again-btn" 
                data-product-id="{{ $orderItem->product->id }}"
                data-product-name="{{ $orderItem->product->name }}"
                data-product-desc="{{ $orderItem->product->description }}"
                data-product-variation="{{ $orderItem->variation }}"
                data-order-item-id="{{ $orderItem->id }}">Rate Product
                </button>
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
<div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Rate Product</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Product Info Section with Image -->
        <div class="product-info-section mb-4 d-flex align-items-start gap-3">
          <div>
            <h4 id="ratingProductName">Product Name</h4>
            <p id="ratingProductDesc" class="text-muted">Product Description</p>
            <p class="variation" id="ratingProductVariation">Variation: </p>
          </div>
        </div>

        <hr>

        <!-- Heart Rating Section -->
        <div class="heart-rating mb-4">
          <h5>Product Quality</h5>
          <div class="d-flex align-items-center">
            <div class="hearts" id="productRating">
              <i class="bi bi-heart heart" data-value="1"></i>
              <i class="bi bi-heart heart" data-value="2"></i>
              <i class="bi bi-heart heart" data-value="3"></i>
              <i class="bi bi-heart heart" data-value="4"></i>
              <i class="bi bi-heart heart" data-value="5"></i>
            </div>
            <span class="ms-2 rating-text">0/5</span>
          </div>
          <input type="hidden" id="ratingValue" name="rating" value="0">
        </div>

        <!-- Product Quality Section -->
<div class="review-box">
  <div class="table-responsive">
    <table class="table table-borderless mb-0">
      <tr>
        <td class="w-25">Appearance:</td>
        <td><textarea class="form-control" placeholder="Write about this Aspect" name="appearance_review"></textarea></td>
      </tr>
      <tr>
        <td class="w-25">Material Quality:</td>
        <td><textarea class="form-control" placeholder="Write about this Aspect" name="material_review" style="margin-bottom: 2rem;"></textarea></td>
      </tr>
    </table>
  </div>

  
  <div class="d-flex align-items-center mb-4">
    <!-- Show Username -->
    <div class="form-check mb-0 me-4">
        <input class="form-check-input" type="checkbox" id="showUsername" name="show_username">
        <label class="form-check-label" for="showUsername">Show username on your review</label>
    </div>


    <!-- Media Upload Section -->
    <div class="d-flex flex-wrap gap-2">
      <!-- Photo Upload -->
      <div class="image-upload-container">
      <label class="upload-label d-flex flex-column align-items-center p-2 rounded text-center">
        <input type="file" id="productImage" accept="image/*" class="d-none">
          <span class="fs-6">Add Photo</span>
        </label>
        <div class="image-preview mt-2 d-flex gap-2" id="imagePreview"></div>
      </div>

      <!-- Video Upload -->
      <div class="video-upload-container">
      <label class="upload-label d-flex flex-column align-items-center p-2 rounded text-center"> 
        <input type="file" id="productVideo" accept="video/*" class="d-none">
          <span class="fs-6">Add Video</span>
        </label>
        <div class="video-preview mt-2 d-flex gap-2" id="videoPreview"></div>
      </div>
    </div>
  </div>
</div>


        <!-- Service Rating Section -->
        <div class="service-rating mb-4">
          <h5>About Service</h5>
          <div class="service-item mb-3">
            <p class="mb-1">Seller Service</p>
            <div class="hearts" id="sellerRating">
              <i class="bi bi-heart heart" data-value="1"></i>
              <i class="bi bi-heart heart" data-value="2"></i>
              <i class="bi bi-heart heart" data-value="3"></i>
              <i class="bi bi-heart heart" data-value="4"></i>
              <i class="bi bi-heart heart" data-value="5"></i>
            </div>
            <input type="hidden" id="sellerRatingValue" name="seller_rating" value="0">
          </div>
          <div class="service-item">
            <p class="mb-1">Delivery Service</p>
            <div class="hearts" id="deliveryRating">
              <i class="bi bi-heart heart" data-value="1"></i>
              <i class="bi bi-heart heart" data-value="2"></i>
              <i class="bi bi-heart heart" data-value="3"></i>
              <i class="bi bi-heart heart" data-value="4"></i>
              <i class="bi bi-heart heart" data-value="5"></i>
            </div>
            <input type="hidden" id="deliveryRatingValue" name="delivery_rating" value="0">
          </div>
        </div>
      </div>

      <div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
  <button type="button" class="btn custom-pink" id="submitRating">Submit Review</button>
</div>

    
    </div>
    </div>
  </div>
</div>


<!-- Rating Success Modal -->
<div class="modal fade" id="ratingSuccessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal text-center p-4">
      <div class="checkmark-wrapper mx-auto mb-3">
        <i class="bi bi-check-lg check-icon"></i>
      </div>
      <p class="modal-text">Your review has been submitted successfully.</p>
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
    let currentOrderId = null;
    let cancelReason = null;
    let currentProductId = null;
    let currentOrderItemId = null;

    const cancelReasonModal = new bootstrap.Modal(document.getElementById('cancelReasonModal'));
    const confirmCancelModal = new bootstrap.Modal(document.getElementById('confirmCancelModal'));
    const cancelSuccessModal = new bootstrap.Modal(document.getElementById('cancelSuccessModal'));
    const ratingModal = new bootstrap.Modal(document.getElementById('ratingModal'));
    const ratingSuccessModal = new bootstrap.Modal(document.getElementById('ratingSuccessModal'));

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

    const tabs = document.querySelectorAll('.order-status-tabs .tab');
    const orders = document.querySelectorAll('.order-box');

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

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const status = tab.getAttribute('data-status');
            filterOrders(status);
        });
    });

    document.querySelector('.tab[data-status="all"]').click();

    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const orderBox = this.closest('.order-box');
            currentOrderId = orderBox.getAttribute('data-order-id');
            cancelReasonModal.show();
        });
    });

    document.getElementById('proceedToConfirm').addEventListener('click', function() {
        const selectedReason = document.querySelector('input[name="cancel_reason"]:checked');
        if (selectedReason) {
            cancelReason = selectedReason.value;
            cancelReasonModal.hide();
            confirmCancelModal.show();
        } else {
            alert('Please select a reason for cancellation.');
        }
    });

    document.getElementById('confirmCancelBtn').addEventListener('click', async function() {
        if (!currentOrderId || !cancelReason) return;

        const confirmBtn = this;
        confirmBtn.disabled = true;
        confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Cancelling...';

        try {
            const response = await fetch(`/orders/${currentOrderId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    reason: cancelReason,
                    _token: document.querySelector('meta[name="csrf-token"]').content
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Failed to cancel order');
            }

            confirmCancelModal.hide();
            cancelSuccessModal.show();

            const orderBox = document.querySelector(`.order-box[data-order-id="${currentOrderId}"]`);
            if (orderBox) {
                orderBox.setAttribute('data-status', 'cancelled');
                const statusInfo = orderBox.querySelector('.status-info');
                if (statusInfo) statusInfo.textContent = 'Cancelled';
            }

            setTimeout(() => {
                cancelSuccessModal.hide();
                location.reload();
            }, 2000);
        } catch (error) {
            console.error('Cancel failed:', error);
            alert(error.message || 'Failed to cancel order. Please try again.');
        } finally {
            confirmBtn.disabled = false;
            confirmBtn.textContent = 'Yes';
        }
    });

    function setupHeartRating(containerId, valueInputId, textElement = null) {
        const hearts = document.querySelectorAll(`#${containerId} .heart`);
        const valueInput = document.getElementById(valueInputId);
        
        hearts.forEach(heart => {
            heart.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                valueInput.value = value;
                
                hearts.forEach((h, index) => {
                    if (index < value) {
                        h.classList.add('bi-heart-fill', 'text-danger');
                        h.classList.remove('bi-heart');
                    } else {
                        h.classList.remove('bi-heart-fill', 'text-danger');
                        h.classList.add('bi-heart');
                    }
                });
                
                if (textElement) {
                    textElement.textContent = `${value}/5`;
                }
            });
        });
    }

    setupHeartRating('productRating', 'ratingValue', document.querySelector('.rating-text'));
    setupHeartRating('sellerRating', 'sellerRatingValue');
    setupHeartRating('deliveryRating', 'deliveryRatingValue');

    function handleMediaUpload(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            preview.innerHTML = '';
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let mediaHTML = '';
                    const isImage = file.type.startsWith('image/');
                    
                    if (isImage) {
                        mediaHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-height:150px;">`;
                    } else if (file.type.startsWith('video/')) {
                        mediaHTML = `<video controls class="img-thumbnail" style="max-height:150px;"><source src="${e.target.result}" type="${file.type}"></video>`;
                    }
                    
                    preview.innerHTML = `
                        <div class="position-relative">
                            ${mediaHTML}
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-1 bg-white rounded-circle" 
                                    aria-label="Remove ${isImage ? 'image' : 'video'}"></button>
                        </div>
                    `;
                    
                    preview.querySelector('.btn-close').addEventListener('click', function() {
                        preview.innerHTML = '';
                        input.value = '';
                    });
                };
                reader.readAsDataURL(file);
            }
        });
    }

    handleMediaUpload('productImage', 'imagePreview');
    handleMediaUpload('productVideo', 'videoPreview');

    document.querySelectorAll('.rate-product-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            currentProductId = this.dataset.productId;
            currentOrderItemId = this.dataset.orderItemId;
            
            document.getElementById('ratingProductName').textContent = this.dataset.productName;
            document.getElementById('ratingProductDesc').textContent = this.dataset.productDesc;
            document.getElementById('ratingProductVariation').textContent = 'Variation: ' + (this.dataset.productVariation || 'Standard');

            resetRatingForm();
            ratingModal.show();
        });
    });

    function resetRatingForm() {
        ['ratingValue', 'sellerRatingValue', 'deliveryRatingValue'].forEach(id => {
            document.getElementById(id).value = 0;
        });

        document.querySelectorAll('.heart').forEach(heart => {
            heart.classList.remove('bi-heart-fill', 'text-danger');
            heart.classList.add('bi-heart');
        });

        document.querySelector('.rating-text').textContent = '0/5';

        document.querySelector('[name="appearance_review"]').value = '';
        document.querySelector('[name="material_review"]').value = '';
        document.getElementById('showUsername').checked = false;

        document.getElementById('imagePreview').innerHTML = '';
        document.getElementById('videoPreview').innerHTML = '';

        document.getElementById('productImage').value = '';
        document.getElementById('productVideo').value = '';
    }

    document.getElementById('submitRating').addEventListener('click', async function() {
        const submitBtn = this;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Submitting...';

        try {
            const ratingValue = document.getElementById('ratingValue').value;
            if (!ratingValue || ratingValue < 1) {
                throw new Error('Please provide at least a 1-star rating');
            }

            const formData = new FormData();

            const showUsernameChecked = document.getElementById('showUsername').checked;

            formData.append('product_id', currentProductId);
            formData.append('order_item_id', currentOrderItemId);
            formData.append('rating', ratingValue);
            formData.append('seller_rating', document.getElementById('sellerRatingValue').value);
            formData.append('delivery_rating', document.getElementById('deliveryRatingValue').value);
            formData.append('appearance_review', document.querySelector('[name="appearance_review"]').value);
            formData.append('material_review', document.querySelector('[name="material_review"]').value);
            formData.append('show_username', showUsername ? 1 : 0);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            
            
            const imageFile = document.getElementById('productImage').files[0];
            if (imageFile) formData.append('image', imageFile);
            
            const videoFile = document.getElementById('productVideo').files[0];
            if (videoFile) formData.append('video', videoFile);

            const response = await fetch('{{ route("submit.rating") }}', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Rating submission failed');
            }

            ratingModal.hide();
            ratingSuccessModal.show();

            document.querySelectorAll('.rate-product-btn').forEach(btn => {
                if (btn.dataset.orderItemId == currentOrderItemId) {
                    btn.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Rated';
                    btn.classList.add('disabled');
                    btn.style.pointerEvents = 'none';
                }
            });

            setTimeout(() => ratingSuccessModal.hide(), 2000);

        } catch (error) {
            console.error('Rating submission error:', error);
            alert(error.message || 'Failed to submit rating. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Review';
        }
    });

    document.querySelector('#ratingSuccessModal .btn-primary').addEventListener('click', function() {
        ratingSuccessModal.hide();
    });

    document.getElementById('profileMenuTrigger')?.addEventListener('click', function (event) {
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
});
</script>


</body>
</html>