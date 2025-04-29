<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📊 Top Products by Quantity Sold</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Pass the topProducts data as data attributes on an HTML element (e.g., the canvas element).
        const labels = JSON.parse('@json($topProducts->map(function($item) { return $item->product->name ?? "Unknown"; }))');
        const data = JSON.parse('@json($topProducts->pluck("total_quantity"))');

        const ctx = document.getElementById('topProductsChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,  // Using the "labels" array
                datasets: [{
                    label: 'Quantity Sold',
                    data: data,  // Using the "data" array
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
