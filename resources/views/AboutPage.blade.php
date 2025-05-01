<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Jowley’s Crafts
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&amp;family=Gotu&amp;family=Oleo+Script+Swash+Caps:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&amp;family=Oleo+Script+Swash+Caps&amp;display=swap" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
   <style>
    body {
      font-family: "Playfair Display", serif;
    }
    p {
      font-family: "Gabarito", serif;
    }
    .fade-in {
      animation: fadeIn 0.5s ease forwards;
    }
    .fade-out {
      animation: fadeOut 0.5s ease forwards;
    }
    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    @keyframes fadeOut {
      from {opacity: 1;}
      to {opacity: 0;}
    }
  </style>
 </link>
 </head>
 <body class="bg-gradient-to-b from-pink-50 to-white min-h-screen">
 <header class="flex items-center justify-between px-6 py-3 border-b-2 border-pink-600 bg-white">
  <div class="flex items-center space-x-4">
    <h1 class="text-pink-600 text-xl font-normal" style="font-family: 'Oleo Script Swash Caps', cursive;">
      Jowley's Craft
    </h1>
    <p class="text-black-600 text-m font-normal">
      About Us
    </p>
  </div>
    <nav class="flex items-center space-x-6 text-sm text-black" style="font-family: 'gabarito';">
      <div class="flex items-center space-x-2">
        <i class="fas fa-bell text-pink-600"></i>
        <span>Notification</span>
      </div>
      <div class="flex items-center space-x-2">
        <i class="fas fa-user text-pink-600"></i>
        <span>Shizuku</span>
      </div>
    </nav>
  </header>
  <div class="max-w-4xl mx-auto p-6">
   <h1 class="text-center text-6xl mb-4 mt-8" style="color: #E32C89; font-family: 'Oleo Script Swash Caps', cursive;">
    About Jowley’s Crafts
   </h1>
   <p class="text-center text-sm max-w-3xl mx-auto mb-8 px-4 leading-tight mt-9">
    Jowley’s Crafts began with a humble stall and the power of social media to
      showcase our one-of-a-kind crochet products and DIY kits. What started as
      a small passion project has grown into a thriving business, thanks to the
      support of our growing community of craft lovers. Our social media
      platforms, including Facebook and TikTok, have allowed us to reach a wider
      audience and share the love behind every handmade creation.
   </p>
   <div class="flex justify-center gap-6 mb-8 px-4" id="image">
    <img alt="tulip bouquet" class="w-40 h-52 object-cover rounded-lg fade fade-in" src="image/3tulip.jpg"/>
    <img alt="daisy bracelet" class="w-40 h-52 object-cover rounded-lg fade fade-in" src="image/daisy-bracelet.jpg"/>
    <img alt="fuzzy flower" class="w-40 h-52 object-cover rounded-lg fade fade-in" src="image/fuzzy-flower.jpg"/>
   </div>
  </div>
  <div class="bg-pink-100 py-8">
   <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-6 px-6">
    <img alt="Crochet flower" class="rounded-lg flex-shrink-0 w-48 h-64 object-cover" src="image/110.jpg"/>
    <p class="text-sm max-w-xl leading-relaxed">
     We specialize in crafting personalized crochet items and providing DIY
        kits for those who want to create something special with their own
        hands. Each product is made with love, attention to detail, and a
        commitment to quality. Whether you’re searching for a unique gift or
        something to brighten up your space, our carefully curated products are
        designed to meet your needs.
    </p>
   </div>
  </div>
  <div class="max-w-4xl mx-auto p-6">
   <h1 class="text-center md:text-left text-4xl mb-4 mt-8" style="color: #E32C89; font-family: 'Oleo Script Swash Caps', cursive;">
    From Passion to Purpose: The Birth of Jowley’s Crafts
   </h1>
   <div class="flex flex-col md:flex-row items-center md:items-start gap-6 px-4">
    <p class="text-sm max-w-full md:max-w-xl leading-tight text-center md:text-left mt-5">
     The story of Jowley’s Crafts began with the creativity and determination of its founder,
        Julie Ann Bitancur. A naturally talented and hardworking individual, 
        Julie discovered her love for arts at an early age through drawing and crafting. 
        What started as a simple hobby turned into commissioned artworks, and eventually, 
        a dream to build something more. In 2023, she took a bold step by showcasing her handmade creations at a small stall
         — a turning point that marked the beginning of her journey as a craft entrepreneur. 
        With her skillful hands and unwavering passion, she began producing a variety of crochet pieces, including floral bouquets, clothing, earrings, and personalized accessories. Each item carries a part of her story and is crafted with care, creativity,
        and love. From humble beginnings, Julie transformed her passion into a thriving brand that now connects with a growing community of handmade art lovers.
    </p>
    <img alt="logo" class="rounded-lg w-60 h-60 object-cover border-4 border-[#E32C89]" src="image/logo-ni-lowley.jpg"/>
   </div>
  </div>
  <script>
   const images = [
      { src: "image/3tulip.jpg", alt: "tulip bouquet" },
      { src: "image/daisy-bracelet.jpg", alt: "daisy bracelet" },
      { src: "image/fuzzy-flower.jpg", alt: "fuzzy flower" },
      { src: "image/lily-keychain.jpg", alt: "lily keychain" },
      { src: "image/mini-flower2.jpg", alt: "mini flower 2" },
      { src: "image/single-tulip.jpg", alt: "single tulip" },
      { src: "image/sunflower.jpg", alt: "sunflower" },
      { src: "image/baby-mushroom.jpg", alt: "baby mushroom" }
    ];

    function shuffle(array) {
      let currentIndex = array.length, randomIndex;
      while (currentIndex !== 0) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;
        [array[currentIndex], array[randomIndex]] = [
          array[randomIndex], array[currentIndex]
        ];
      }
      return array;
    }

    function shuffleAlbum() {
      const albumDiv = document.getElementById("image");
      const imgElements = albumDiv.querySelectorAll("img");
      const shuffled = shuffle([...images]).slice(0, imgElements.length);

      imgElements.forEach((img, index) => {
        img.classList.remove("fade-in");
        img.classList.add("fade-out");

        setTimeout(() => {
          img.src = shuffled[index].src;
          img.alt = shuffled[index].alt;
          img.classList.remove("fade-out");
          img.classList.add("fade-in");
        }, 500);
      });
    }

    shuffleAlbum();
    setInterval(shuffleAlbum, 3000);
  </script>
 </body>
</html>