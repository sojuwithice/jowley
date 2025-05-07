<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>

<body>
    <!-- Header Section -->
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

    <!-- Navigation Section -->
    <header class="scroll-fade">
        <nav class="navbar">
        <nav class="navbar">
        <a href="{{ route('homepage') }}">Home</a>
        <a href="{{ route('shop.index') }}">Products</a>
        <a href="{{ route('faqs') }}">FAQs</a>
    </nav>
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
        </div>
    </header>

    @auth
    <x-notifications-modal 
        :notifications="auth()->user()->notifications"
        :unreadCount="auth()->user()->unreadNotifications->count()" />
@else
    <x-notifications-modal :notifications="[]" :unreadCount="0" />
@endauth

    <!-- Main Content Area -->
    <div class="main-container">
        <div class="container">
            <!-- Sidebar Filters -->
            <aside class="search-filter">
                <div class="filter-header">SEARCH FILTER</div>
                @isset($products)
                    @php
                        $availableCategories = $products->pluck('category')->unique()->filter()->values();
                    @endphp
                    
                    @if($availableCategories->isNotEmpty())
                        <div class="category-container">
                            <button class="category-dropdown" onclick="toggleCategory()">
                                By Category <span class="dropdown-icon">▼</span>
                            </button>
                            <ul class="category-list">
                                @foreach($availableCategories as $category)
                                    <li class="category">
                                        <a href="{{ route('shop.index', array_merge(request()->all(), ['category' => $category])) }}">
                                            {{ $category }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endisset
            </aside>

            <!-- Product Content -->
            <main class="content">
                <!-- Sorting Controls -->
                <div class="sorting-controls">
                    <div class="search-sort">
                        <div class="search-results">
                            @if(!empty($searchTerm))
                                Search results for <b>‘{{ $searchTerm }}’</b>
                            @else
                                Showing all products
                            @endif
                        </div>

                        <div class="sort-options">
                            <span>Sort by:</span>
                            <a href="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'relevance'])) }}" 
                               class="sort-btn {{ request('sort') == 'relevance' ? 'active' : '' }}">Relevance</a>
                            <a href="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'latest'])) }}" 
                               class="sort-btn {{ request('sort') == 'latest' ? 'active' : '' }}">Latest</a>
                            <a href="{{ route('shop.index', array_merge(request()->all(), ['sort' => 'top'])) }}" 
                               class="sort-btn {{ request('sort') == 'top' ? 'active' : '' }}">Top Products</a>
                        </div>
                    </div>

                       <!-- Sorting options container -->
                       <div class="price-sorting">
    <div class="custom-dropdown" id="priceDropdown">
        <button class="dropdown-toggle" type="button" onclick="togglePriceDropdown()">
            <span class="dropdown-text">Price</span>
            <span class="dropdown-icon">
                <i class="fas fa-chevron-down"></i>
            </span>
        </button>
        <div class="dropdown-options">
            <a href="{{ route('shop.index', array_merge(request()->all(), ['price_sort' => 'low-to-high'])) }}"
               class="{{ request('price_sort') == 'low-to-high' ? 'active' : '' }}">
               Low to High
            </a>
            <a href="{{ route('shop.index', array_merge(request()->all(), ['price_sort' => 'high-to-low'])) }}"
               class="{{ request('price_sort') == 'high-to-low' ? 'active' : '' }}">
               High to Low
            </a>
        </div>
    </div>
</div>





                 <!-- Products Section -->
       
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5 scroll-fade">
                @forelse ($products as $product)
                    <div class="col">
                        <div class="product-card">
                            @php
                                $defaultImage = 'default.jpg';
                                $rawImages = $product->images;
                                $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
                                $imageFilename = $images[0] ?? $defaultImage;
                                $imageFilename = str_replace('\\', '/', $imageFilename);
                                $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
                            @endphp
                            <img src="{{ asset($finalPath) }}" alt="{{ $product->name }}" class="product-img">

                            <p class="product-text">{{ $product->name }}</p>
                            <div class="product-name-daily">
                                <div class="heart-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= 3 ? 'fa-solid' : 'fa-regular' }} fa-heart text-warning fs-5" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="product-details">
                                <span class="price">₱{{ $product->price }}</span>
                                <span class="sold-count">{{ $product->sold }} sold</span>
                            </div>
                            <div class="view-details">
                                <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="btn-details">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse
            </div>
</section>

                <!-- Pagination -->
                <div class="pagination">
                    @if ($products->onFirstPage())
                        <span class="page-nav disabled">&lt;</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="page-nav">&lt;</a>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        @if ($i == $products->currentPage())
                            <span class="page active">{{ $i }}</span>
                        @else
                            <a href="{{ $products->url($i) }}" class="page">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="page-nav">&gt;</a>
                    @else
                        <span class="page-nav disabled">&gt;</span>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Scroll animation
    const scrollElements = document.querySelectorAll(".scroll-fade");
    const scrollObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            entry.isIntersecting 
                ? entry.target.classList.add("show") 
                : entry.target.classList.remove("show");
        });
    }, { threshold: 0.2 });
    
    scrollElements.forEach(el => scrollObserver.observe(el));

    // Cart loading spinner
    const cartLink = document.querySelector('.cart-icon-link');
    if (cartLink) {
        cartLink.addEventListener('click', function() {
            const spinner = this.querySelector('.spinner-border');
            spinner.classList.remove('d-none');
            this.classList.add('disabled');
            setTimeout(() => {
                this.classList.remove('disabled');
                spinner.classList.add('d-none');
            }, 3000);
        });
    }

    // Category dropdown functionality
    const categoryDropdownBtn = document.querySelector('.category-dropdown');
    if (categoryDropdownBtn) {
        categoryDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const categoryList = this.closest('.category-container').querySelector('.category-list');
            const dropdownIcon = this.querySelector('.dropdown-icon');
            
            if (categoryList && dropdownIcon) {
                // Close price dropdown if open
                document.querySelector('.price-dropdown-container')?.classList.remove('active');
                
                // Toggle category dropdown
                categoryList.classList.toggle('show');
                dropdownIcon.classList.toggle('rotate');
            }
        });
    }

    function togglePriceDropdown() {
    const dropdown = document.getElementById('priceDropdown');
    dropdown.classList.toggle('open');
}

    // Price dropdown functionality - NEW IMPLEMENTATION
    const priceDropdown = document.getElementById('priceDropdown');
    const toggleButton = priceDropdown.querySelector('.dropdown-toggle');

    toggleButton.addEventListener('click', function (e) {
        e.stopPropagation();
        priceDropdown.classList.toggle('open');
    });

    document.addEventListener('click', function (e) {
        if (!priceDropdown.contains(e.target)) {
            priceDropdown.classList.remove('open');
        }
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
});
</script>
</body>
</html>