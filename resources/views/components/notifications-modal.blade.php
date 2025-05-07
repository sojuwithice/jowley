<!-- Overlay -->
<div class="modal-overlay" id="modalOverlay"></div>

<!-- Modal -->
<div id="notificationModal" class="notification-modal">
    <div class="modal-header">
        <h3>Your Notifications</h3>
        <div style="display: flex; align-items: center; gap: 10px;">
        <a href="{{ route('notifications.all') }}" class="view-all-btn">View All</a>
            <button class="close-modal">&times;</button>
        </div>
    </div>

    <!-- Unread summary -->
    <div style="padding: 10px 20px; font-weight: 500; color: #888; border-bottom: 1px solid #ccc;">
        You have <strong><span id="unreadCount">{{ $unreadCount ?? 0 }}</span> unread notification(s)</strong>
    </div>

    <div class="modal-body">
        @if(isset($notifications) && count($notifications) > 0)
            @foreach($notifications as $notification)
                <div class="notification-item {{ $notification->unread() ? 'unread' : '' }}" data-id="{{ $notification->id }}">
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
        @else
            <div class="empty-notifications">
                <i class="fas fa-bell-slash" style="font-size: 2rem; color: #E32C89;"></i>
                <p>No notifications yet</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* Overlay */
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
        transition: background-color 0.3s;
    }

    .notification-item.unread {
        background-color: rgba(227, 44, 137, 0.05);
    }

    .notification-item:hover {
        background-color: rgba(227, 44, 137, 0.08);
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

    .notification-time {
        font-size: 0.8rem;
        color: #888;
        margin-top: 8px;
    }

    .empty-notifications {
        padding: 40px 20px;
        text-align: center;
        color: #666;
    }

    .empty-notifications i {
        margin-bottom: 15px;
    }

    .empty-notifications p {
        margin: 0;
        font-size: 1.1rem;
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
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #fff5f8;
        border-radius: 10px;
        border: 1px solid #f5d6e0;
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
        min-width: 0;
    }

    .details-button {
        background: none;
        border: 1px solid #ff4fa0;
        color: #ff4fa0;
        border-radius: 16px;
        padding: 6px 14px;
        font-size: 10px;
        cursor: pointer;
        transition: all 0.3s;
        white-space: nowrap;
        margin-left: 10px;
    }

    .details-button:hover {
        background: #ff4fa0;
        color: #fff;
    }

    /* Scrollbar styling */
    .notification-modal::-webkit-scrollbar {
        width: 5px;
    }

    .notification-modal::-webkit-scrollbar-thumb {
        background-color: #E32C89;
        border-radius: 10px;
    }

    @media (max-width: 600px) {
        .notification-modal {
            width: 95%;
            max-width: none;
        }
        
        .notification-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .details-button {
            align-self: flex-end;
            margin-top: 10px;
            margin-left: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal elements
        const modal = document.getElementById('notificationModal');
        const overlay = document.getElementById('modalOverlay');
        const notificationButton = document.getElementById('notificationButton');
        const closeBtn = document.querySelector('.close-modal');
        const badge = document.getElementById('notificationBadge');
        const unreadCountElement = document.getElementById('unreadCount');
        
        // Notification items
        const notificationItems = document.querySelectorAll('.notification-item[data-id]');

        // Modal functions
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

        // Event listeners
        if (notificationButton) {
            notificationButton.addEventListener('click', function(e) {
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

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'block') {
                closeModal();
            }
        });

        // Mark as read functionality
        notificationItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't mark as read if clicking on the "View Details" button
                if (e.target.classList.contains('details-button')) {
                    return;
                }

                const notificationId = this.getAttribute('data-id');
                
                if (this.classList.contains('unread')) {
                    fetch(`/notifications/${notificationId}/read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.remove('unread');
                            
                            // Update counts
                            const currentUnread = parseInt(unreadCountElement.textContent);
                            unreadCountElement.textContent = currentUnread - 1;
                            
                            if (badge) {
                                const currentBadge = parseInt(badge.textContent);
                                badge.textContent = currentBadge - 1;
                                
                                if (currentBadge - 1 <= 0) {
                                    badge.style.display = 'none';
                                }
                            }
                        }
                    });
                }
            });
        });

        // Hide badge if count is 0
        if (badge && parseInt(badge.textContent) === 0) {
            badge.style.display = 'none';
        }

        // Real-time notifications with Pusher (optional)
        @if(auth()->check())
            const userId = {{ auth()->id() }};
            
            Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {
                    // Update badge count
                    if (badge) {
                        const currentBadge = parseInt(badge.textContent) || 0;
                        badge.textContent = currentBadge + 1;
                        badge.style.display = 'inline-block';
                    }
                    
                    // Update unread count
                    const currentUnread = parseInt(unreadCountElement.textContent) || 0;
                    unreadCountElement.textContent = currentUnread + 1;
                    
                    // Add new notification to the top
                    const modalBody = document.querySelector('.modal-body');
                    const firstItem = modalBody.firstElementChild;
                    
                    if (firstItem.classList.contains('empty-notifications')) {
                        modalBody.innerHTML = '';
                    }
                    
                    const newNotification = document.createElement('div');
                    newNotification.className = 'notification-item unread';
                    newNotification.setAttribute('data-id', notification.id);
                    newNotification.innerHTML = `
                        <div class="notification-content">
                            <img src="${notification.image || '{{ asset('image/default-notification.png') }}'}" class="notification-image" alt="Notification">
                            <div class="notification-text">
                                <h4 class="notification-title">${notification.title}</h4>
                                <p class="notification-message">${notification.message}</p>
                                <div class="notification-time">Just now</div>
                            </div>
                            <a href="${notification.action_url}" class="details-button">View Details</a>
                        </div>
                    `;
                    
                    modalBody.insertBefore(newNotification, modalBody.firstChild);
                });
        @endif
    });
</script>