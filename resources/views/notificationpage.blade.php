<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
   
</head>
<body>
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
                <li><a href="#">My Profile</a></li>
                <li><a href="{{ route('purchasepage') }}">My Purchases</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    @endguest
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

<div class="notification-content-wrapper">
    <div class="container">
        <div class="header">
            <h1>Your Notifications</h1>
            <div class="action-buttons">
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-mark-all-read">
                        <i class="fas fa-check-circle me-1"></i> Mark All as Read
                    </button>
                </form>
                <form action="{{ route('notifications.clear-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-clear-all">
                        <i class="fas fa-trash-alt me-1"></i> Clear All
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @forelse($notifications as $notification)
                    <div class="notification-item {{ $notification->unread() ? 'unread' : '' }}">
                        <div class="notification-content">
                            <div class="icon">
                                <i class="fas fa-bell text-primary fs-4"></i>
                            </div>
                            <div class="details">
                                <h5>{{ $notification->data['title'] ?? 'Notification' }}</h5>
                                <p>{{ $notification->data['message'] ?? '' }}</p>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-notifications">
                        <i class="fas fa-bell-slash text-muted fs-1 mb-3"></i>
                        <p>No notifications yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


        <!-- Only show pagination if using paginate() -->
        @if(method_exists($notifications, 'links'))
        <div class="mt-3 d-flex justify-content-center">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>