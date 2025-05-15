<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="vh-100 m-0 p-0">
    <div class="container-fluid row text-bg-light h-100 w-100 p-0">
        <?= view('admin/dashboard/components/sidebar') ?>
        <div class="col-10 overflow-auto p-0">
            <div class="w-100 shadow-sm mh-10 py-4 mb-4 px-5 bg-white d-flex flex-row-reverse">
                <a href="<?= base_url("/logout") ?>" class="btn text-bg-danger text-wrap">Logout</a>
            </div>
            
            <div class="px-5 py-4">
                <div class="shadow rounded bg-white p-4 overflow-auto">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                    <h3>Dashboard</h3>

                    <div class="row">
                        <div class="col-9">
                            <canvas id="salesChart"></canvas>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-between h-100 gap-4">
                            <div class="card shadow-sm">
                            <div class="card-body d-flex align-items-center flex-column">
                                <h3 class="card-title"><?= $totalInvoices ?></h3>  
                                <p class="card-text">Total Transactions</p>
                            </div>
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-body d-flex align-items-center flex-column">
                                <h3 class="card-title"><?= 'Rp'.number_format($totalRevenue, 0, ',', '.') ?></h3>  
                                <p class="card-text">Total Revenues</p>
                            </div>
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-body d-flex align-items-center flex-column">
                                <h3 class="card-title"><?= $totalCompanies ?></h3>  
                                <p class="card-text">Total Mitras</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesChart = document.getElementById('salesChart');
        const salesData = <?= json_encode($salesData) ?>;
        const salesLabels = salesData.map(item => item.month);
        const salesValues = salesData.map(item => item.total_sales);

        new Chart(salesChart, {
            type: 'bar',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Sales Past 6 Months',
                    data: salesValues,
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
</body>
</html>