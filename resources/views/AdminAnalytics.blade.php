<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Analytics - Top Products by Quantity Sold</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700;900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <style>
        body {
            font-family: 'Gabarito', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 h-full w-64 bg-pink-600 border-l-8 border-pink-600 flex flex-col overflow-hidden">
        <div class="px-6 py-8">
            <a href="#" class="text-white font-oleo text-3xl select-none block font-['Oleo_Script_Swash_Caps']">Jowley's Crafts</a>
        </div>
        <ul class="flex flex-col mt-4 px-0 flex-grow">
    <li class="mb-3">
        <a href="{{ route('dashboard') }}"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="home-outline"></ion-icon>
            </span>
            <span class="title text-m">Dashboard</span>
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('analytics') }}"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="analytics-outline"></ion-icon>
            </span>
            <span class="title text-m">Analytics</span>
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('products.addProduct') }}"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="cube-outline"></ion-icon>
            </span>
            <span class="title text-m">Products</span>
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('admin.products') }}"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="help-outline"></ion-icon>
            </span>
            <span class="title text-m">Inventory</span>
        </a>
    </li>
    <li class="mb-3">
    <a href="#"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="settings-outline"></ion-icon>
            </span>
            <span class="title text-m">Settings</span>
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('logout') }}"
            class="flex items-center text-white px-6 py-3 rounded-l-3xl hover:bg-white hover:text-black transition-colors duration-300 font-extralight">
            <span class="icon text-2xl flex justify-center w-14 mr-4">
                <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="title text-m">Sign Out</span>
        </a>
    </li>
</ul>
</nav>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-6">
        <div class="container mx-auto py-5">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow">
                    <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                        <h5 class="mb-0 text-lg font-semibold flex items-center gap-2">📊 Top Products by Quantity Sold</h5>
                    </div>
                    <div class="p-6">
                        <canvas id="topProductsChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const labels = JSON.parse('@json($topProducts->map(function($item) { return $item->product->name ?? "Unknown"; }))');
        const data = JSON.parse('@json($topProducts->pluck("total_quantity"))');

        const ctx = document.getElementById('topProductsChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantity Sold',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
