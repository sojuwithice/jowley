<!DOCTYPE html>
<html>
<head>

    <title>Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/search.css') }}">


</head>
<body>
<div class="top-header scroll-fade">
    <div class="left">
        <a href="#" class="logo">Jowley's Craft</a>
    </div>

    <div class="right">
        <a href="#" class="notification">
            <i class="fas fa-bell"></i> Notification
        </a>
        <a href="#" class="user-profile">
            <i class="fas fa-user"></i> AkosiMJ#01
        </a>
    </div>
</div>
</body>
</html>

<!-- header section starts  -->
<header class="scroll-fade">
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#products">Products</a>
    </nav>

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
</header>

<!-- product list -->

<div class="container">
        <aside class="search-filter">
            <div class="filter-header">SEARCH FILTER</div>
            
            <div class="category-container">
        <button class="category-dropdown" onclick="toggleCategory()">
            By Category <span class="dropdown-icon">▼</span>
        </button>
        <ul class="category-list">
            <li class="category">Bracelet</li>
            <li class="category">Necklace</li>
            <li class="category">Earring</li>
            <li class="category">Ring</li>
        </ul>
    </div>
        </aside>

        <main class="content">
            
            <!-- Search and Sorting -->
            <div class="search-sort">
                <div class="search-results">
                    Search results for <b>‘Accessories’</b>
                </div>
                <div class="sort-options">
                    <span>Sort by</span>
                    <button class="sort-btn">Relevance</button>
                    <button class="sort-btn">Latest</button>
                    <button class="sort-btn">Top Products</button>
                </div>
            </div>

            <!-- Price Sorting -->
            <div class="sort-pagination">
    <div class="dropdown">
        <button class="price-btn" type="button">Price <i class="fas fa-chevron-down"></i></button>
        <div class="dropdown-content">
            <a href="#" data-sort="low-to-high">Low to High</a>
            <a href="#" data-sort="high-to-low">High to Low</a>
        </div>
    </div>
</div>



            <section class="daily-container scroll-fade">
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5 scroll-fade">
        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/mini-flower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                    <p class="product-text">Mini Fuzzy Flower</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱55</span>
                    <span class="sold-count">20 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/baby-mushroom.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Cute Baby Mushroom</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱55</span>
                    <span class="sold-count">20 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/crochet-top.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Handmade Crochet Top</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱300</span>
                    <span class="sold-count">3 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/single-tulip.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Single Tulip Crochet Bouquet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱130</span>
                    <span class="sold-count">140 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/sunflower.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Crochet Sunflower Bouquet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱160</span>
                    <span class="sold-count">5 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/earrings.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Tulip Earrings</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱40</span>
                    <span class="sold-count">50 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/headband.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Tulip Headband</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱90</span>
                    <span class="sold-count">10 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="product-card">
                <img src="{{ asset('image/daisy-bracelet.jpg') }}" alt="Mini Fuzzy Flower" class="product-img">
                <p class="product-text">Daisy Bracelet</p>
                <div class="product-name-daily">
                    <div class="heart-rating">
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="1"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="2"></i>
                        <i class="fa-solid fa-heart text-warning fs-5" data-value="3"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="4"></i>
                        <i class="fa-regular fa-heart text-warning fs-5" data-value="5"></i>
                    </div>
                </div>

                <div class="product-details">
                    <span class="price">₱49</span>
                    <span class="sold-count">87 sold</span>
                </div>

                <div class="view-details">
                    <button class="btn-details">View Details</button>
                </div>
            </div>
        </div>
    </div>

            <div class="pagination" id="pagination">
                <button class="page-nav" id="prevPage">&lt;</button>
                <button class="page">1</button>
                <button class="page">2</button>
                <button class="page">3</button>
                <button class="page">4</button>
                <button class="page">5</button>
                <button class="page-nav" id="nextPage">&gt;</button>
            </div>
        </main>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scrollElements = document.querySelectorAll(".scroll-fade");
            const scrollObserver = new IntersectionObserver(
                (entries) => {
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

        document.addEventListener("DOMContentLoaded", function () {
            const cartLink = document.querySelector('.cart-icon-link');
            if (cartLink) {
                cartLink.addEventListener('click', function (e) {
                    const spinner = this.querySelector('.spinner-border');
                    spinner.classList.remove('d-none');
                    this.classList.add('disabled');
                    setTimeout(() => {
                        this.classList.remove('disabled');
                        spinner.classList.add('d-none');
                    }, 3000);
                });
            }
        });

        // Category Filter
        document.querySelectorAll(".category").forEach(button => {
            button.addEventListener("click", function () {
                const category = this.getAttribute("data-category");
                filterProducts(category);
            });
        });

        function filterProducts(category) {
            console.log("Filtering by category: ", category);
            // Add logic to filter products dynamically based on category
        }

        // Search Functionality
        document.getElementById("searchBtn").addEventListener("click", function () {
            const query = document.getElementById("searchInput").value;
            searchProducts(query);
        });

        function searchProducts(query) {
            console.log("Searching for: ", query);
            // Add logic to filter products dynamically based on search query
        }

        // Sort Functionality
        document.querySelectorAll(".sort").forEach(button => {
            button.addEventListener("click", function () {
                const sortType = this.getAttribute("data-sort");
                sortProducts(sortType);
            });
        });

        function sortProducts(sortType) {
            console.log("Sorting by: ", sortType);
            // Add logic to sort products dynamically based on sortType
        }
        

        function toggleCategory() {
    const categoryList = document.querySelector('.category-list');
    const dropdownIcon = document.querySelector('.dropdown-icon');

    categoryList.classList.toggle('show');
    dropdownIcon.classList.toggle('rotate');
}

document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector(".dropdown");
    const priceBtn = document.querySelector(".price-btn");
    const sortOptions = dropdown?.querySelectorAll(".dropdown-content a");
    const prevPageBtn = document.getElementById("prevPage");
    const nextPageBtn = document.getElementById("nextPage");
    const pageNumber = document.getElementById("pageNumber");
    let currentPage = 1;
    const totalPages = 7;
    

// Open/Close the dropdown when the price button is clicked
if (priceBtn) {
    priceBtn.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent event from bubbling up to window
        console.log("Dropdown button clicked!"); // Debugging log
        dropdownContent.classList.toggle("show"); // Toggle visibility
    });
}

// Close the dropdown if clicked outside
window.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        dropdownContent.classList.remove('show'); // Close the dropdown
    }
});


    // ✅ Add event listeners to sorting options
    sortOptions.forEach(option => {
        option.addEventListener("click", function (event) {
            const selectedOption = event.target.textContent;
            priceBtn.innerHTML = `Price: ${selectedOption} <i class="fas fa-chevron-down"></i>`;
            dropdown.classList.remove("active");

            // Implement sorting logic here
            console.log(`Sorting by: ${selectedOption}`);
        });
    });

    // ✅ Sort option functionality
    if (sortOptions) {
        sortOptions.forEach(option => {
            option.addEventListener("click", function (event) {
                event.preventDefault();
                const sortType = this.getAttribute("data-sort");
                console.log("Sorting by:", sortType);
                dropdown.classList.remove("active");
            });
        });
    }

    // ✅ Pagination functionality
    if (prevPageBtn && nextPageBtn && pageNumber) {
        prevPageBtn.addEventListener("click", function () {
            if (currentPage > 1) {
                currentPage--;
                updatePageNumber();
            }
        });

        nextPageBtn.addEventListener("click", function () {
            if (currentPage < totalPages) {
                currentPage++;
                updatePageNumber();
            }
        });

        function updatePageNumber() {
            pageNumber.textContent = `${currentPage}/${totalPages}`;
        }
    }
});


        
    </script>
</body>
</html>










