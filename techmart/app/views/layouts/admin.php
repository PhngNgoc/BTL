<!-- app/views/layouts/admin.php -->
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'TechMart Admin'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tabler Core CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">

    <style>
        body { background-color: #f5f7fb; }
        .navbar-brand-text { font-weight: 600; font-size: 1.2rem; }
    </style>
</head>
<body class="layout-fluid">

<div class="page">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-xl">
            <a class="navbar-brand" href="<?= BASE_URL ?>index.php?url=admin/dashboard/index">
                <span class="navbar-brand-text">TechMart Admin</span>
            </a>

            <div class="navbar-nav flex-row order-md-last">
                <a class="nav-link" href="<?= BASE_URL ?>index.php" target="_blank">
                    Xem website
                </a>
            </div>
        </div>
    </header>

    <div class="page-wrapper">
        <!-- Body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 col-lg-2 mb-3">
                        <div class="list-group">
                            <a href="<?= BASE_URL ?>index.php?url=admin/dashboard/index"
                               class="list-group-item list-group-item-action<?= (($activeMenu ?? '') === 'dashboard') ? ' active' : '' ?>">
                                Dashboard
                            </a>

                            <a href="<?= BASE_URL ?>index.php?url=admin/product/index"
                               class="list-group-item list-group-item-action<?= (($activeMenu ?? '') === 'products') ? ' active' : '' ?>">
                                Quản lý sản phẩm
                            </a>

                            <a href="<?= BASE_URL ?>index.php?url=admin/order/index"
                               class="list-group-item list-group-item-action<?= (($activeMenu ?? '') === 'orders') ? ' active' : '' ?>">
                                Quản lý đơn hàng
                            </a>
                        </div>
                    </div>

                    <!-- Main content -->
                    <div class="col-md-9 col-lg-10">
                        <?= $content ?? '' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-12">
                        <p class="mb-0">
                            © <?= date('Y') ?> TechMart Admin
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Tabler Core JS -->
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js"></script>
</body>
</html>
