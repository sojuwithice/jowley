<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700;900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
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
                <a href="#" id="settingsLink"
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

    <!-- Settings Content -->
    <div id="settingsContent" class="flex-1 ml-64">
        <div class="flex flex-1 flex-col md:flex-row max-w-4xl mx-auto w-full min-h-screen bg-white shadow-md rounded-md my-8 mx-6 md:mx-6">
            <!-- Sidebar / Tab Navigation -->
            <nav aria-label="Admin Settings Navigation" class="w-full md:w-64 border-b md:border-b-0 md:border-r border-gray-200 bg-white flex md:flex-col">
                <button class="tab-btn flex-1 md:flex-none md:w-full px-4 py-3 md:py-4 text-left text-black-700-lg hover:bg-gray-100 focus:bg-gray-100 focus:outline-none border-b md:border-b-0 md:border-l-4 md:border-transparent md:hover:border-pink-500 md:focus:border-pink-600 md:font-lg hover:text-pink-600" data-tab="profile" type="button">
                    <i class="fas fa-user-cog mr-2"></i>
                    Profile Settings
                </button>
                <button class="tab-btn flex-1 md:flex-none md:w-full px-4 py-3 md:py-4 text-left text-black-700-lg hover:bg-gray-100 focus:bg-gray-100 focus:outline-none border-b md:border-b-0 md:border-l-4 md:border-transparent md:hover:border-pink-500 md:focus:border-pink-600 md:font-lg hover:text-pink-600" data-tab="shop" type="button">
                    <i class="fas fa-store mr-2"></i>
                    Shop Settings
                </button>
                <button class="tab-btn flex-1 md:flex-none md:w-full px-4 py-3 md:py-4 text-left text-black-700-lg hover:bg-gray-100 focus:bg-gray-100 focus:outline-none border-b md:border-b-0 md:border-l-4 md:border-transparent md:hover:border-pink-500 md:focus:border-pink-600 md:font-lg hover:text-pink-600" data-tab="notifications" type="button">
                    <i class="fas fa-bell mr-2"></i>
                    Notifications
                </button>
            </nav>
            <!-- Content Area -->
            <main class="flex-1 p-6 overflow-auto">
                <!-- Profile Settings -->
                <section class="tab-content max-w-3xl mx-auto" id="profile">
                    <h2 class="text-2xl font-xl mb-6 text-pink-700">Profile Settings</h2>
                    <form autocomplete="off" class="space-y-6" id="profileForm" novalidate>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="fullName">Full Name</label>
                            <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="fullName" name="fullName" placeholder="Fullname" required type="text" />
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="email">Email Address</label>
                            <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="email" name="email" placeholder="name@gmail.com" required type="email" />
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="contactNumber">Contact Number</label>
                            <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="contactNumber" name="contactNumber" placeholder="+1 234 567 8900" type="tel" />
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Profile Picture</label>
                            <div class="flex items-center space-x-4">
                                <img alt="Placeholder profile picture" class="w-20 h-20 rounded-full object-cover border border-gray-300" height="80" id="profilePicPreview" src="image/logo-ni-lowley.jpg" width="80" />
                                <div>
                                    <input accept="image/*" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer" id="profilePic" name="profilePic" type="file" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="password">Change Password</label>
                            <input autocomplete="new-password" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="password" name="password" placeholder="New password" type="password" />
                        </div>
                        <div>
                            <button class="inline-flex items-center justify-center rounded-md bg-pink-600 px-5 py-2 text-white font-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-1" type="submit">Save Profile</button>
                        </div>
                    </form>
                </section>
                <!-- Shop Settings -->
                <section class="tab-content hidden max-w-3xl mx-auto" id="shop">
                    <h2 class="text-2xl font-lg mb-6 text-pink-800">Shop Settings</h2>
                    <form autocomplete="off" class="space-y-6" id="shopForm" novalidate>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="shopName">Shop Name</label>
                            <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="shopName" name="shopName" placeholder="Jowley's Crafts" required type="text" />
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Shop Logo</label>
                            <div class="flex items-center space-x-4">
                                <img alt="Placeholder shop logo" class="w-24 h-24 object-contain border border-gray-300 rounded-md" height="100" id="shopLogoPreview" src="https://storage.googleapis.com/a1aa/image/d25078ac-a677-462c-7e7b-5f5e2d32da04.jpg" width="100" />
                                <div>
                                    <input accept="image/*" class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 cursor-pointer" id="shopLogo" name="shopLogo" type="file" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1" for="shopAddress">Shop Address</label>
                            <textarea class="w-full rounded-md border border-gray-300 px-3 py-2 resize-y focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="shopAddress" name="shopAddress" placeholder="123 Main St, Springfield, IL 62704" required rows="3"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Business Hours</label>
                            <div class="grid grid-cols-2 gap-4 max-w-sm">
                                <div>
                                    <label class="block text-gray-600 text-sm mb-1" for="businessOpen">Open</label>
                                    <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="businessOpen" name="businessOpen" required type="time" />
                                </div>
                                <div>
                                    <label class="block text-gray-600 text-sm mb-1" for="businessClose">Close</label>
                                    <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="businessClose" name="businessClose" required type="time" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Social Media Links</label>
                            <div class="space-y-3 max-w-md">
                                <div>
                                    <label class="block text-gray-600 text-sm mb-1" for="facebook">Facebook</label>
                                    <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="facebook" name="facebook" placeholder="https://facebook.com/yourpage" type="url" />
                                </div>
                                <div>
                                    <label class="block text-gray-600 text-sm mb-1" for="instagram">Instagram</label>
                                    <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="instagram" name="instagram" placeholder="https://instagram.com/yourprofile" type="url" />
                                </div>
                                <div>
                                    <label class="block text-gray-600 text-sm mb-1" for="tiktok">TikTok</label>
                                    <input class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" id="tiktok" name="tiktok" placeholder="https://tiktok.com/@yourprofile" type="url" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="inline-flex items-center justify-center rounded-md bg-pink-600 px-5 py-2 text-white font-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-1" type="submit">Save Shop Settings</button>
                        </div>
                    </form>
                </section>
                <!-- Notifications -->
                <section class="tab-content hidden max-w-3xl mx-auto" id="notifications">
                    <h2 class="text-2xl font-lg mb-6 text-pink-800">Shop Notifications Settings</h2>
                    <form autocomplete="off" class="space-y-6" id="notificationsForm" novalidate>
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                            <div>
                                <p class="font-medium text-gray-700">New Order Placed</p>
                                <p class="text-sm text-gray-500">Notify when an order is placed</p>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer" for="notifNewOrder">
                                <input checked class="sr-only peer" id="notifNewOrder" type="checkbox" />
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-600 peer-focus:ring-2 peer-focus:ring-pink-500 transition"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3 pt-3">
                            <div>
                                <p class="font-medium text-gray-700">Order Cancelled</p>
                                <p class="text-sm text-gray-500">Notify when an order is cancelled</p>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer" for="notifOrderCancelled">
                                <input class="sr-only peer" id="notifOrderCancelled" type="checkbox" />
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-600 peer-focus:ring-2 peer-focus:ring-pink-500 transition"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3 pt-3">
                            <div>
                                <p class="font-medium text-gray-700">Order Delivered</p>
                                <p class="text-sm text-gray-500">Notify when an order is delivered</p>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer" for="notifOrderDelivered">
                                <input checked class="sr-only peer" id="notifOrderDelivered" type="checkbox" />
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-600 peer-focus:ring-2 peer-focus:ring-pink-500 transition"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3 pt-3">
                            <div>
                                <p class="font-medium text-gray-700">Low Inventory Alert</p>
                                <p class="text-sm text-gray-500">Notify when stocks are low</p>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer" for="notifLowInventory">
                                <input checked class="sr-only peer" id="notifLowInventory" type="checkbox" />
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-600 peer-focus:ring-2 peer-focus:ring-pink-500 transition"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between pt-3">
                            <div>
                                <p class="font-medium text-gray-700">Payment Received</p>
                                <p class="text-sm text-gray-500">Notify when a payment is confirmed</p>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer" for="notifPaymentReceived">
                                <input checked class="sr-only peer" id="notifPaymentReceived" type="checkbox" />
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-pink-600 peer-focus:ring-2 peer-focus:ring-pink-500 transition"></div>
                                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transform peer-checked:translate-x-5 transition"></div>
                            </label>
                        </div>
                        <div class="pt-6">
                            <button class="inline-flex items-center justify-center rounded-md bg-pink-600 px-5 py-2 text-white font-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1" type="submit">Save Notification Settings</button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>

    <script>
        // Tab navigation logic
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-content");

        function activateTab(tabName) {
            tabContents.forEach((section) => {
                if (section.id === tabName) {
                    section.classList.remove("hidden");
                } else {
                    section.classList.add("hidden");
                }
            });
            tabButtons.forEach((btn) => {
                if (btn.dataset.tab === tabName) {
                    btn.classList.add("border-indigo-600", "bg-indigo-50", "font-semibold");
                    btn.classList.remove("border-transparent");
                } else {
                    btn.classList.remove("border-indigo-600", "bg-indigo-50", "font-semibold");
                    btn.classList.add("border-transparent");
                }
            });
        }

        tabButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                activateTab(btn.dataset.tab);
            });
        });

        // Show profile tab by default on page load
        document.addEventListener("DOMContentLoaded", () => {
            activateTab("profile");
        });

        // Profile Picture Preview
        const profilePicInput = document.getElementById("profilePic");
        const profilePicPreview = document.getElementById("profilePicPreview");
        profilePicInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    profilePicPreview.src = ev.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Shop Logo Preview
        const shopLogoInput = document.getElementById("shopLogo");
        const shopLogoPreview = document.getElementById("shopLogoPreview");
        shopLogoInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    shopLogoPreview.src = ev.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Prevent form submissions for demo
        document.getElementById("profileForm").addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Profile settings saved.");
        });
        document.getElementById("shopForm").addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Shop settings saved.");
        });
        document.getElementById("notificationsForm").addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Notification settings saved.");
        });
    </script>
</body>
</html>