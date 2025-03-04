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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- top header bar starts-->
<div class="top-header">
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

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    
    <a href="#" class="logo">Jowely's Crafts</a>


    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#products">Products</a>
        <a href="#aboutus">About Us</a>
    </nav>

    <div class="icons">
        <a href="#" class="fas fa-magnifying-glass"></a>
        <a href="#" class="fas fa-user"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
    </div>

</header>

<!-- header section ends -->

<!-- home section starts -->

<section class="home" id="home">

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
    <div style="background-image: url('{{ asset('storage/images/tulip-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('storage/images/keychain.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('storage/images/fuzzy-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('storage/images/butterfly-flower.jpg') }}');"></div>
    <div style="background-image: url('{{ asset('storage/images/bracelet.jpg') }}');"></div>
    </div>

</section>

<!-- home section ends -->







    
</section>