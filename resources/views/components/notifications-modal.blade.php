<!-- Overlay -->
<div class="modal-overlay" id="modalOverlay"></div>

<!-- Modal -->
<div id="notificationModal" class="notification-modal">
    <div class="modal-header">
        <h3>Today received notifications</h3>
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="#" class="view-all-btn">View All</a>
            <button class="close-modal">&times;</button>
        </div>
    </div>

    <!-- Unread summary -->
    <div style="padding: 10px 20px; font-weight: 500; color: #888; border-bottom: 1px solid #ccc;">
        You have <strong>1 unread notification</strong>
    </div>

    <div class="modal-body">
        <!-- Sample Notification 1 -->
        <div class="notification-item unread">
            <div class="notification-content">
            <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="notification-image">
                <div class="notification-text">
                    <h4 class="notification-title">Shipped Out</h4>
                    <p class="notification-message">
                        Parcel 10920275 has been shipped out by Jowley’s Crafts via JNT Express. Click here to see order details and track your parcel.
                    </p>
                    <div class="notification-time">2 minutes ago</div>
                </div>
                <button class="details-button">View Details</button>
            </div>
        </div>

        <!-- Sample Notification 2 -->
        <div class="notification-item">
            <div class="notification-content">
            <img src="{{ asset('image//sunflower.jpg') }}" alt="Sunflower" class="notification-image">
                <div class="notification-text">
                    <h4 class="notification-title">New Arrival</h4>
                    <p class="notification-message">We have new products that you may like. Check it out!</p>
                    <div class="notification-time">1 hour ago</div>
                </div>
                <button class="details-button">View Details</button>
            </div>
        </div>

        <!-- Sample Notification 3 -->
        <div class="notification-item">
            <div class="notification-content">
            <img src="{{ asset('image/tulip-flower.jpg') }}" alt="Tulip" class="notification-image">
                <div class="notification-text">
                    <h4 class="notification-title">Rate Product</h4>
                    <p class="notification-message">Seller is waiting for your feedback on your recent purchase.</p>
                    <div class="notification-time">2 days ago</div>
                </div>
                <button class="details-button">View Details</button>
            </div>
        </div>

        @if(isset($notifications) && count($notifications) > 0)
            @foreach($notifications as $notification)
            <div class="notification-item {{ $notification->unread() ? 'unread' : '' }}">
                <div class="notification-content">
                    @isset($notification->data['image'])
                    <img src="{{ $notification->data['image'] }}" class="notification-image" alt="Notification Image">
                    @endisset
                    <div class="notification-text">
                        <h4 class="notification-title">{{ $notification->data['title'] ?? 'Notification' }}</h4>
                        <p class="notification-message">{{ $notification->data['message'] ?? '' }}</p>
                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @isset($notification->data['action_url'])
                    <a href="{{ $notification->data['action_url'] }}" class="details-button">View Details</a>
                    @endisset
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>



<style>
    /* Overlay */
/* Modal Overlay - Full Page */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 9999;
}

/* Modal Container */
.notification-modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    max-width: 500px;
    max-height: 80vh;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.2);
    z-index: 10000;
    overflow-y: auto;
}

.modal-header {
    padding: 15px 20px;
    border-bottom: 2px solid #E32C89;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    background: white;
    z-index: 1;
}

.modal-header h3 {
    margin: 0;
    font-size: 1.8rem;
    color: #333;
    font-family: 'Gabarito', sans-serif;
}

#notificationButton {
    position: relative;
    display: inline-block;
}

.notification-badge {
    position: absolute;
    top: -8px;
    right: -4px;
    background-color: #E32C89;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.7rem;
    font-weight: bold;
    line-height: 1;
    z-index: 10;
    display: inline-block;
}


.close-modal {
    background: none;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    color: #666;
    transition: color 0.3s;
}

.close-modal:hover {
    color: #E32C89;
}

.notification-item {
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.notification-item.unread {
    background-color: rgba(227, 44, 137, 0.05);
}

.notification-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #E32C89;
    margin: 0 0 5px 0;
    font-family: 'Gabarito', sans-serif;
}

.notification-message {
    font-size: 0.95rem;
    color: #555;
    margin: 0 0 10px 0;
    line-height: 1.4;
}

.notification-action {
    display: inline-block;
    color: #E32C89;
    font-size: 0.9rem;
    text-decoration: none;
    margin-bottom: 8px;
    font-weight: 500;
    transition: color 0.3s;
}

.notification-action:hover {
    color: #b81d6b;
    text-decoration: underline;
}

.notification-time {
    font-size: 0.8rem;
    color: #888;
    margin-top: 8px;
}

.empty-notifications {
    padding: 30px;
    text-align: center;
    color: #666;
    font-style: italic;
}

.view-all-btn {
    background: #E32C89;
    color: white;
    padding: 5px 15px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s;
}

.view-all-btn:hover {
    background: #c02674;
}

.notification-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #fff5f8;
    border-radius: 10px;
    border: 1px solid #f5d6e0;
    margin-bottom: 15px;
}

.notification-image {
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
}

.notification-text {
    flex: 1;
}

.details-button {
    background: none;
    border: 1px solid #ff4fa0;
    color: #ff4fa0;
    border-radius: 16px;
    padding: 6px 14px;
    font-size: 10px;
    cursor: pointer;
    transition: background 0.3s;
}

.details-button:hover {
    background: #ff4fa0;
    color: #fff;
}

/* Scrollbar styling - short, auto-hide style */
.notification-modal::-webkit-scrollbar {
    width: 5px;
}

.notification-modal::-webkit-scrollbar-track {
    background: transparent;
}

.notification-modal::-webkit-scrollbar-thumb {
    background-color: transparent;
    border-radius: 9999px;
    transition: background-color 0.3s ease;
    min-height: 30px;
}

/* Show thumb only on hover */
.notification-modal:hover::-webkit-scrollbar-thumb {
    background-color: #E32C89;
}


/* Notification Button (keep your existing button styles) */
</style>

<script>
  
    document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('notificationModal');
    const overlay = document.getElementById('modalOverlay');
    const btn = document.getElementById('notificationButton');
    const closeBtn = document.querySelector('.close-modal');
    const badge = document.getElementById('notificationBadge');

    function openModal() {
        overlay.style.display = 'block';
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        overlay.style.display = 'none';
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    if (btn && modal) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });

    // Hide badge if count is 0
    if (badge && parseInt(badge.textContent) === 0) {
        badge.style.display = 'none';
    }
});
</script>

