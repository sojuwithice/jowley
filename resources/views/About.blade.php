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
        .navbar { padding: 15px 30px; background: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); }
        .navbar-brand {
            font-family: 'Oleo Script Swash Caps', cursive;
            font-size: 32px;
            color: #E32C89 !important;
        }
        .navbar a { margin: 0 15px; font-weight: 500; }
        .highlight-section { background: #fdecef; padding: 40px 0; }
        .icon { font-size: 1.3rem; cursor: pointer; }
        .search-box { border-radius: 20px; border: 1px solid #ddd; padding: 8px 15px; }
    </style>
</head>
<body>
    <header class="navbar d-flex justify-content-between align-items-center">
        <h2 class="ms-3 navbar-brand">Jowley's Craft</h2>
        <nav>
            <a href="#" class="text-dark">Home</a>
            <a href="#" class="text-dark">Products</a>
            <a href="#" class="text-dark">About Jowley’s</a>
        </nav>
        <div class="d-flex align-items-center">
            <input type="text" class="search-box me-3" placeholder="Search...">
            <i class="fas fa-bell icon me-3"></i>
            <i class="fas fa-shopping-cart icon me-3"></i>
            <span class="fw-bold">AkosiMJ#01</span>
        </div>
    </header>
    
    <section class="hero">
        <h1>Jowley’s Crafts</h1>
        <p>Jowley's Crafts began with a humble stall and the power of social media to showcase our one-of-a-kind crochet products and DIY kits...</p>
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
    
    <footer class="text-center p-3 mt-5">&copy; 2025 Jowley’s Crafts - Every piece tells a story.</footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
