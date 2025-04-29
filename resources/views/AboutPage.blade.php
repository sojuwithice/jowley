<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Jowley's Crafts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background Styles */
        .about {
            position: relative;
            overflow: hidden;
        }

        .about .absolute {
            position: absolute;
            top: 100px !important;
            inset: 0;
            justify-content: flex-start;
            display: inline-flex;
            flex-direction: row;
            z-index: 0;
        }

        .about .absolute .bg-shape1 {
            width: 400px;
            height: 400px;
            border-radius: 9999px;
            position: relative;
            animation: one 10s infinite;
        }

        .about .absolute .bg-shape2 {
            width: 300px;
            height: 300px;
            border-radius: 9999px;
            position: relative;
            animation: two 10s infinite;
        }

        @keyframes one {
            0%{left: 0px; top: 0px}
            25%{left: -100px; top: 70px}
            50%{left: 20px; top: 150px}
            75%{left: 50px; top: 100px}
            100%{left: 0px; top: 0px}
        }

        @keyframes two {
            0%{left: 0px; top: 0px}
            25%{left: 50px; top: 10px}
            50%{left: 100px; top: 50px}
            75%{left: 50px; top: 100px}
            100%{left: 0px; top: 0px}
        }

        .about .absolute .opacity-50 {
            opacity: .5;
        }

        .about .absolute .bg-blur {
            filter: blur(90px);
        }

        .about .absolute .bg-primary {
            background-color: #b96c78 !important;
        }

        .about .absolute .bg-pink {
            background-color: #de5097 !important;
        }

        /* About Page Content Styles */
        .about-hero {
            padding: 5rem 0;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-family: 'Oleo Script Swash Caps', cursive;
            font-size: 3.5rem;
            margin-bottom: 2rem;
            color: #2c3e50;
        }

        .about-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .mission-section, .story-section, .values-section {
            margin: 2rem 0;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
        }

        .values-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .values-section li {
            padding: 0.5rem 0;
            font-size: 1.1rem;
        }

        .values-section li:before {
            content: "🧶";
            margin-right: 0.8rem;
        }

        /* General Styles */
        body {
            background: whitesmoke;
            font-family: 'Gotu', sans-serif;
        }
    </style>
</head>
<body>
    <section class="about scroll-fade" id="about">
        <div class="absolute inset-0 justify-center">
            <div class="bg-shape1 bg-pink opacity-50 bg-blur"></div>
            <div class="bg-shape2 bg-primary opacity-50 bg-blur"></div>
        </div>

        <section class="hero about-hero">
            <div class="container">
                <h2 class="section-title">About Jowley's Crafts</h2>
                <div class="about-content">
                    <p class="lead">Jowley's Crafts began with a humble stall and the power of social media to showcase our one-of-a-kind crochet products and DIY kits. What started as a small passion project has grown into a thriving business, thanks to the support of our growing community of craft lovers.</p>
                    
                    <div class="mission-section">
                        <h3>Our Mission</h3>
                        <p>We aim to bring handmade warmth into every home while empowering others to discover the joy of crafting through our easy-to-use DIY kits.</p>
                    </div>

                    <div class="story-section">
                        <h3>Our Story</h3>
                        <p>Founded in 2020 by Joanna "Jowley" Smith, our craft business started as a weekend hobby at local markets. Through social media platforms like Instagram and TikTok, we've been able to connect with craft enthusiasts worldwide and share our passion for handmade creations.</p>
                    </div>

                    <div class="values-section">
                        <h3>Our Values</h3>
                        <ul>
                            <li>Quality craftsmanship</li>
                            <li>Sustainable materials</li>
                            <li>Community support</li>
                            <li>Creative education</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>