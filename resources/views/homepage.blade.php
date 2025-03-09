<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- top header bar starts-->
<div class="top-header scroll-fade">
    <div class="left">
        <span>Follow us on</span>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
    </div>
    <div class="right">
        <a href="#" class="signup">Sign Up</a>
        <a href="#" class="login">Log in</a>
    </div>
</div>

<!-- top header bar ends -->

<!-- header section starts -->

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
            <a href="#" class="fas fa-shopping-cart"></a>
        </div>
    </div>


</header>

<!-- header section ends -->

<!-- home section starts -->

<section class="home scroll-fade" id="home">

    <div class="content">
        <h3>Handmade with love, crafted for you. </h3>
        <p>Discover handmade products crafted to match your unique taste.<br>
        Find the perfect DIY creations you've been searching for, made with love and attention to detail!</p>
    </div>

    <div class="absolute inset-0 justify-center">
        <div class="bg-shape1 bg-pink opacity-50 bg-blur"></div>
        <div class="bg-shape2 bg-primary opacity-50 bg-blur"></div>
    </div>


    <div class="img-wrapper">
    <div style="background-image: url('{{ asset('image/tulip-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/keychain.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/fuzzy-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/butterfly-bouquet.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('image/bracelet.jpg') }}');"></div>
    </div>

</section>

<!-- home section ends -->

<!-- new arrival -->

<section class="new-arrival scroll-fade" id="new-arrival">
    <h2>New Arrivals</h2>
    <div class="new-product-container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <img src="{{ asset('image/coin-purse.png') }}" class="img" alt="Coin Purse">
                    <div class="content">
                        <h2>New Crafted Items!</h2>
                        <p class="description">We have a new product for you.</p>
                        <p class="see">See more details:</p>
                        <a href="#" class="btn btn-primary">Coin Purse</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <img src="{{ asset('image/hair-clips.png') }}" class="img" alt="Crocheted Hair Clips">
                    <div class="content">
                        <h2>New Crafted Items!</h2>
                        <p class="description">We have a new product for you.</p>
                        <p class="see">See more details:</p>
                        <a href="#" class="btn btn-primary">Crocheted Hair Clips</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- catgories -->

<section class="categories scroll-fade">
    <h2>Find Things You’ll Love</h2>
    <div class="category-container">
        <div class="category">
            <div class="circle">
             <img src="{{ asset('image/categ-bracelet.png') }}" alt="Bracelet">
            </div>
            <span>Bracelet</span>
        </div>
        <div class="category">
            <div class="circle">
             <img src="{{ asset('image/categ-keychain.png') }}" alt="Keychain">
            </div>    
            <span>Keychain</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/categ-bouquet.png') }}" alt="Bouquet">
            </div>
            <span>Bouquet</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/hair-accessories.png') }}" alt="Hair Accessories">
            </div>
                <span>Hair Accessories</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/clothes.png') }}" alt="Clothes">
            </div>
                <span>Clothes</span>
        </div>
        <div class="category">
            <div class="circle">
                <img src="{{ asset('image/wallet.png') }}" alt="Wallet">
            </div>
                <span>Wallet</span>
        </div>
    </div>
</section>



</section>







    
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
                        entry.target.classList.remove("show"); // Magdi-disappear ulit kapag di na kita
                    }
                });
            },
            { threshold: 0.2 }
        );

        scrollElements.forEach((el) => scrollObserver.observe(el));
    });
</script>