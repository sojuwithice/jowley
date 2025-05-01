<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Gotu&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">
    <title>Jowley's Crafts - Orders</title>
    <link rel="stylesheet" href="{{ asset('css/admindash.css') }}">
    <style>
        .order-container {
            padding: 20px;
        }
        .order-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
        }
        .order-items th {
            background: #f8f9fa;
            padding: 10px;
            text-align: left;
        }
        .order-items td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: capitalize;
        }
        .status-to-pay { background: #fff3cd; color: #856404; }
        .status-to-ship { background: #cce5ff; color: #004085; }
        .status-to-receive { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-completed { background: #e2e3e5; color: #383d41; }
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 15px;
        }
        .action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .update-status {
            background: #007bff;
            color: white;
        }
        .view-details {
            background: #6c757d;
            color: white;
        }
        .confirm-payment {
            background: #28a745;
            color: white;
        }
        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
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
            </div>

            <div class="order-container">
                <div class="cardHeader">
                    <h2>All Orders</h2>
                    <div>
                        <select id="status-filter" class="btn">
                            <option value="">All Statuses</option>
                            <option value="to pay">To Pay</option>
                            <option value="to ship">To Ship</option>
                            <option value="to receive">To Receive</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                @foreach($orders as $order)
                <div class="order-card" data-status="{{ $order->status }}">
                    <div class="order-header">
                        <div>
                            <h3>Order #{{ $order->id }}</h3>
                            <p>Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div>
                            <span class="status-badge status-{{ str_replace(' ', '-', $order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="customer-info">
                        <p><strong>Customer:</strong> {{ $order->full_name }} (User ID: {{ $order->user_id }})</p>
                        <p><strong>Contact:</strong> {{ $order->phone_number }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    <table class="order-items">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <td>
                                    @php
                                        $defaultImage = 'default.jpg';
                                        $rawImages = $item->product->images;
                                        $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
                                        $imageFilename = $images[0] ?? $defaultImage;
                                        $imageFilename = str_replace('\\', '/', $imageFilename);
                                        $finalPath = \Illuminate\Support\Str::startsWith($imageFilename, 'image/') ? $imageFilename : 'image/' . $imageFilename;
                                    @endphp
                                    <img src="{{ asset($finalPath) }}" alt="{{ $item->product->name }}" width="50">
                                </td>
                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₱{{ number_format($item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="action-buttons">
                        @if($order->status == 'to pay')
                            <button class="action-btn confirm-payment" data-order-id="{{ $order->id }}">
                                Confirm Payment
                            </button>
                        @else
                            <select class="action-btn update-status" data-order-id="{{ $order->id }}">
                                <option value="">Update Status</option>
                                <option value="to ship" {{ $order->status == 'to ship' ? 'selected' : '' }}>To Ship</option>
                                <option value="to receive" {{ $order->status == 'to receive' ? 'selected' : '' }}>To Receive</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button class="action-btn view-details">View Details</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script>
        // Status filter functionality
        document.getElementById('status-filter').addEventListener('change', function() {
            const status = this.value;
            const orderCards = document.querySelectorAll('.order-card');
            
            orderCards.forEach(card => {
                if (status === '' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Update status functionality
        document.querySelectorAll('.update-status').forEach(select => {
            select.addEventListener('change', function() {
                const orderId = this.dataset.orderId;
                const newStatus = this.value;
                
                if (newStatus) {
                    updateOrderStatus(orderId, newStatus);
                }
            });
        });

        // Confirm payment functionality
        document.querySelectorAll('.confirm-payment').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.dataset.orderId;
                if (confirm('Are you sure you want to confirm this payment?')) {
                    updateOrderStatus(orderId, 'to ship');
                }
            });
        });

        function updateOrderStatus(orderId, newStatus) {
            fetch(`/orders/${orderId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating status');
            });
        }
    </script>
</body>
</html>