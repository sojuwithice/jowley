<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FAQs - Jowley's Craft</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700;900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Gabarito', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen">
  <header class="border-b border-pink-500">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-2">
      <div class="flex items-center space-x-6">
        <h1 class="text-pink-600 text-2xl select-none" style="font-family: 'Oleo Script Swash Caps', cursive;">Jowley's Craft</h1>
      </div>
      <div class="flex items-center space-x-6 text-black text-sm">

        

      </div>
    </div>
    <nav class="max-w-7xl mx-auto flex items-center justify-center space-x-10 px-4 py-3 bg-white">
      <a href="{{route('homepage')}}" class="text-black text-base hover:underline">Home</a>
      <a href="{{route('shop.index')}}" class="text-black text-base hover:underline">Products</a>
      <a href="{{route('faqs')}}" class="text-black text-base hover:underline">FAQs</a>

   
      <form class="ml-10 flex items-center border border-pink-600 rounded-full px-3 py-1 max-w-xs w-full" action="#" method="GET" role="search">
        <input
          type="search"
          name="search"
          placeholder="Search..."
          class="outline-none text-sm text-black placeholder-pink-600 bg-transparent flex-grow"
          aria-label="Search"
        />
        <button type="submit" class="text-pink-600 ml-2">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <button class="ml-6 text-pink-600 text-xl" aria-label="Cart">
        <i class="fas fa-shopping-cart"></i>
      </button>

    </nav>
  </header>

  <!-- Main content -->
  <main class="max-w-6xl mx-auto px-4 py-10">
    <div class="w-full bg-gradient-to-b from-white via-white to-pink-300 rounded-md p-8 mb-10 text-center">
      <h1 class="text-8xl font-lg text-pink-600 mb-2">FAQs</h1>
      <p class="text-gray-800 font-semibold">Frequently Asked Questions</p>
    </div>

    <!-- Question 1 -->
    <section class="mb-8">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq1"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq1', this)"
      >
        <span>Where is Jowley's Crafts based?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq1"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq1"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            Jowley's Crafts is proudly based in Bicol, Albay, Philippines. We started as a small local stall and have grown into a home-based online store, actively selling through Facebook, TikTok, and our website.
          </span>
        </p>
      </div>
    </section>

    <!-- Ordering & Customization heading -->
    <h2 class="text-pink-600 font-semibold text-lg mb-4">Ordering &amp; Customization</h2>

    <!-- Question 2 -->
    <section class="mb-6">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq2"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq2', this)"
      >
        <span>How do I place an order?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq2"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq2"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            You can place an order directly through our website or by messaging us on Facebook or TikTok. Just choose the product you like, confirm your order details, and wait for our confirmation message.
          </span>
        </p>
      </div>
    </section>

    <!-- Question 3 -->
    <section class="mb-8">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq3"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq3', this)"
      >
        <span>Can I request custom designs or names?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq3"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq3"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            Yes! Most of our products are customizable. You can request colors, names, themes, or other details — just message us your preferences when ordering.
          </span>
        </p>
      </div>
    </section>

    <!-- Shipping, Pickup & Delivery heading -->
    <h2 class="text-pink-600 font-semibold text-lg mb-4">Shipping, Pickup &amp; Delivery</h2>

    <!-- Question 4 -->
    <section class="mb-6">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq4"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq4', this)"
      >
        <span>What are your delivery options?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq4"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq4"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            We offer:<br />
            • Local Pickup or Meet-Up (specific areas only)<br />
            • Nationwide Delivery via trusted couriers (J&T, LBC, etc.)
          </span>
        </p>
      </div>
    </section>

    <!-- Question 5 -->
    <section class="mb-6">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq5"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq5', this)"
      >
        <span>How long does delivery take?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq5"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq5"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            Since we only ship within Albay, orders are processed and shipped within 1 day.<br />
            Delivery typically takes 2–3 days, depending on the distance and location within the province.
          </span>
        </p>
      </div>
    </section>

    <!-- Payment Options heading -->
    <h2 class="text-pink-600 font-semibold text-lg mb-4">Payment Options</h2>

    <!-- Question 6 -->
    <section class="mb-6">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq6"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq6', this)"
      >
        <span>What payment methods do you accept?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq6"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq6"
      >
        <p class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <span>
            We accept:<br />
            • GCash<br />
            • Cash on Delivery (COD) – available in selected areas only
          </span>
        </p>
      </div>
    </section>

    <!-- Contact & Social Media heading -->
    <h2 class="text-pink-600 font-semibold text-lg mb-4">Contact &amp; Social Media</h2>

    <!-- Question 7 -->
    <section class="mb-6">
      <button
        type="button"
        aria-expanded="true"
        aria-controls="faq7"
        class="w-full text-left border border-black rounded-md py-2 px-4 text-gray-900 font-semibold hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 flex justify-between items-center"
        onclick="toggleFaq('faq7', this)"
      >
        <span>How can I reach you for questions or orders?</span>
        <span class="text-pink-600 font-bold">...</span>
      </button>
      <div
        id="faq7"
        class="mt-2 border border-black rounded-md bg-pink-50 p-4"
        role="region"
        aria-labelledby="faq7"
      >
        <div class="text-gray-700 text-sm leading-relaxed flex items-start space-x-2">
          <span aria-hidden="true" class="flex-shrink-0 text-pink-600 pt-0.5">
            <i class="far fa-question-circle"></i>
          </span>
          <div>
            <p>You can contact us through:</p>
            <p class="mt-2 font-semibold">Facebook Pages:</p>
            <ul class="list-disc list-inside space-y-1">
              <li>
                <a href="https://www.facebook.com/profile.php?id=100095150080013" target="_blank" class="text-pink-600 hover:underline">
                  JOWLEY Crafts
                </a>
              </li>
              <li>
                <a href="https://www.facebook.com/julieann.bitancur.13" target="_blank" class="text-pink-600 hover:underline">
                  Julie Ann Bitancur
                </a>
              </li>
            </ul>
            <p class="mt-2 font-semibold">TikTok:</p>
            <p>
              <a href="https://www.tiktok.com/@jowley.crafts" target="_blank" class="text-pink-600 hover:underline">
                @jowley.crafts
              </a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    function toggleFaq(id, btn) {
      const panel = document.getElementById(id);
      const expanded = btn.getAttribute("aria-expanded") === "true";
      if (expanded) {
        panel.classList.add("hidden");
        btn.setAttribute("aria-expanded", "false");
        btn.querySelector("span:last-child").textContent = "...";
      } else {
        panel.classList.remove("hidden");
        btn.setAttribute("aria-expanded", "true");
        btn.querySelector("span:last-child").textContent = "...";
      }
    }
    
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

  </script>
</body>
</html>