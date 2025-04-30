<!DOCTYPE html>
<html lang="en">
                                                                                
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <title>Jowley's Crafts</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="css/admindash.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="StoreName">Jowley's Crafts</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('analytics') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Analytics</span>
                    </a>
                </li>
                <li>
                <a href="{{ route('products.addProduct') }}">
                <span class="icon">
             <ion-icon name="cube-outline"></ion-icon>
        </span>
        <span class="title">Products</span>
    </a>
    </li>
        <li>
                 <a href="{{ route('admin.products') }}">
                   <span class="icon">
                    <ion-icon name="help-outline"></ion-icon>
                    </span>
                        <span class="title">Inventory</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
                <span style="margin-left: 30px; margin-top:30px; font-size: 26px;">Overview</span>
<div class="cardBox">

    <a href="{{ route('users') }}">
    <div class="card">
        <div>
        <div class="numbers">{{ $nonAdminUserCount }}</div>
            <div class="cardName">Users</div>
        </div>
        <div class="iconBx">
            <ion-icon name="person-outline"></ion-icon>
        </div>
    </div>
    </a>
    <div class="card">
    <div>
         <div class="numbers">{{ $totalSales }}</div>
            <div class="cardName">Sales</div> </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <!-- Replaced Comments with Orders -->
    <div class="card">
        <div>
            <div class="numbers">{{ $orderCount }}</div>
            <div class="cardName">Orders</div>
        </div>
        <div class="iconBx">
            <ion-icon name="receipt-outline"></ion-icon>
        </div>
    </div>
                <div class="card">
                    <div>
                        <div class="numbers">₱{{ number_format($earnings, 2) }}</div>
                        <div class="cardName">Earnings</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Product ID</td>
                                <td>Product Image</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Payment</td>
                                <td>Status</td>
                            </tr>
                        </thead>


<tbody>
    @foreach($recentOrders as $item)
        <tr>
            <td>{{ $item->product->id ?? 'N/A' }}</td>
            <td>
            @php
                            $defaultImage = 'default.jpg';
                            $rawImages = $item->product->images;

                            $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;

                            $imageFilename = $images[0] ?? $defaultImage;

                            $imageFilename = str_replace('\\', '/', $imageFilename);

                            $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;

                        @endphp

                        <img src="{{ asset($finalPath) }}" alt="{{ $item->product->name }}" width="100">
            </td>
            <td>{{ $item->product->name ?? 'N/A' }}</td>
            <td>₱{{ number_format($item->price, 2) }}</td>
            <td>{{ $item->order->payment_method ?? 'N/A' }}</td>
            <td>
                <span class="status {{ strtolower($item->order->status ?? 'pending') }}">
                    {{ ucfirst($item->order->status ?? 'Pending') }}
                </span>
            </td>
        </tr>
    @endforeach
</tbody>

                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <script>
    // Add hovered class to selected list item
    let list = document.querySelectorAll(".navigation li");

    function activeLink() {
        list.forEach((item) => {
            item.classList.remove("hovered");
        });
        this.classList.add("hovered");
    }

    list.forEach((item) => item.addEventListener("mouseover", activeLink));

    // Menu Toggle
    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".navigation");
    let main = document.querySelector(".main");

    toggle.onclick = function () {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
    };

    </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
 </body>
</html>