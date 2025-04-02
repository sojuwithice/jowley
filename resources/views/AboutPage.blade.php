<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jowley's Crafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&display=swap');
        body { font-family: 'Gabarito', sans-serif; }
        .hero { font-family: 'Gotu', sans-serif; background: linear-gradient(to bottom, #fdecef, white); padding: 60px 20px; text-align: center; }
        .product-img { width: 100%; height: auto; border-radius: 10px; }
        .section-title { text-align: center; margin-top: 40px; }
        .about-text { max-width: 800px; margin: 0 auto; text-align: center; }
        .top-header { display: flex; justify-content: space-between; padding: 10px 20px; background-color: #f8f9fa; }
        .top-header .logo { font-family: 'Oleo Script Swash Caps', cursive; font-size: 32px; color: #E32C89; }
        .top-header .right a { margin-left: 15px; font-weight: 500; }
        .navbar { padding: 15px 30px; background: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); }
        .navbar a { margin: 0 15px; font-weight: 500; }
        .header-right { display: flex; align-items: center; justify-content: flex-end; }
        .search-bar { display: flex; }
        .search-bar input { border-radius: 20px; border: 1px solid #ddd; padding: 8px 15px; }
        .icons { margin-left: 15px; }
        .icon { font-size: 1.3rem; cursor: pointer; }
        .highlight-section {font-family: 'Gabarito'; background: #fdecef; padding: 40px 0; }
        .bottom { font-family: 'Gabarito'; background: white ; padding: 60px 20px; text-align: center; }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
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

    <!-- Header Section -->
    <header>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#products">Products</a>
            <a href="#contactus">FAQs</a>
        </nav>

        <div class="header-right">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart cart-icon-link">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Jowley’s Crafts</h1>
        <p>Jowley's Crafts began with a humble stall and the power of social media to showcase our one-of-a-kind crochet products and DIY kits. What started as a small passion project has grown into a thriving business, thanks to the support of our growing community of craft lovers. Our social media platforms, including Facebook and TikTok, have allowed us to reach a wider audience and share the love behind every handmade creation.</p>
    </section>

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <img src="product1.jpg" alt="Product 1" class="product-img">
            </div>
            <div class="col-md-4">
                <img src="product2.jpg" alt="Product 2" class="product-img">
            </div>
            <div class="col-md-4">
                <img src="product3.jpg" alt="Product 3" class="product-img">
            </div>
        </div>
    </div>
    
    <section class="highlight-section text-center mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="highlight.jpg" alt="Feature" class="product-img">
                </div>
                <div class="col-md-6 text-start">
                    <p>We specialize in crafting personalized crochet items and providing DIY kits for those who want to create something special with their own hands...</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bottom">
                    <p>Our DIY kits come with everything you need to get started, offering a fun and creative way to engage with the craft. With a focus on personalization, we give you the opportunity to create something that reflects your own style. At Jowley's Crafts, we believe every piece tells a story—your story!</p>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
