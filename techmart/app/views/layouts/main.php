<!-- app/views/layouts/main.php -->
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>
        <?= isset($title) ? htmlspecialchars($title) . ' | TechMart' : 'TechMart' ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons (icon giỏ hàng, người dùng) -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- CSS custom của bạn -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/site.css">
</head>
<body class="bg-light">

<header class="ts-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>index.php?url=home/index">
                <div class="ts-logo d-flex align-items-center justify-content-center me-2">
                    <span class="ts-logo-icon"></span>
                </div>
                <span class="fw-bold">TechMart</span>
            </a>

            <!-- Nút toggle cho mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu giữa -->
            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav ms-4">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?url=about/index">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?url=faq/index">Hỏi & Đáp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>index.php?url=contact/index">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <!-- Menu phải -->
            <div class="ms-auto d-flex align-items-center gap-3">
                <!-- Icon user -->
                <a href="<?= BASE_URL ?>index.php?url=auth/login"
                   class="btn btn-link ts-icon-btn">
                    <i class="bi bi-person-fill"></i>
                </a>

                <!-- Giỏ hàng -->
                <a href="<?= BASE_URL ?>index.php?url=cart/index"
                   class="btn btn-link ts-icon-btn position-relative">
                    <i class="bi bi-cart-fill"></i>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <span class="badge bg-danger rounded-pill ts-cart-badge">
                            <?= count($_SESSION['cart']) ?>
                        </span>
                    <?php endif; ?>
                </a>

<?php if (!empty($_SESSION['user'])): ?>
    <!-- Nếu đã đăng nhập -->
    <span class="me-2 fw-bold">
        Xin chào, <?= htmlspecialchars($_SESSION['user']['full_name'] ?? $_SESSION['user']['username']) ?>
    </span>
    

    <a href="<?= BASE_URL ?>index.php?url=auth/logout"
       class="btn btn-outline-secondary rounded-pill px-4">
        Đăng xuất
    </a>
<?php else: ?>
    <!-- Nếu chưa đăng nhập -->
    <a href="<?= BASE_URL ?>index.php?url=auth/login"
       class="btn btn-primary rounded-pill px-4">
        Đăng nhập
    </a>
<?php endif; ?>
<?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a href="<?= BASE_URL ?>index.php?url=admin/dashboard/index"
       class="btn btn-outline-primary ms-3">
        Trang quản trị
    </a>
<?php endif; ?>

            </div>
        </div>
    </nav>
</header>

<main class="ts-main">
    <?= $content ?? '' ?>
</main>

<footer class="ts-footer mt-5">
    <div class="ts-footer-top py-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Cột logo + mô tả -->
                <div class="col-md-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="ts-logo me-2">
                            <span class="ts-logo-icon"></span>
                        </div>
                        <span class="fw-bold text-white">TechMart</span>
                    </div>
                    <p class="text-white-50 mb-3">
                        Cửa hàng công nghệ hàng đầu với sản phẩm chất lượng cao và dịch vụ tuyệt vời.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="ts-social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="ts-social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="ts-social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Cột sản phẩm -->
                <div class="col-md-3">
                    <h6 class="text-white mb-3">Sản phẩm</h6>
                    <ul class="list-unstyled text-white-50 mb-0">
                        <li><a href="#" class="ts-footer-link">Điện thoại</a></li>
                        <li><a href="#" class="ts-footer-link">Laptop</a></li>
                        <li><a href="#" class="ts-footer-link">Tai nghe</a></li>
                        <li><a href="#" class="ts-footer-link">Phụ kiện</a></li>
                    </ul>
                </div>

                <!-- Cột hỗ trợ -->
                <div class="col-md-3">
                    <h6 class="text-white mb-3">Hỗ trợ</h6>
                    <ul class="list-unstyled text-white-50 mb-0">
                        <li><a href="<?= BASE_URL ?>index.php?url=about/index" class="ts-footer-link">Giới thiệu</a></li>
                        <li><a href="<?= BASE_URL ?>index.php?url=faq/index" class="ts-footer-link">Hỏi & Đáp</a></li>
                        <li><a href="<?= BASE_URL ?>index.php?url=contact/index" class="ts-footer-link">Liên hệ</a></li>
                        <li><a href="#" class="ts-footer-link">Chính sách bảo hành</a></li>
                        <li><a href="#" class="ts-footer-link">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="ts-footer-link">Chính sách đổi trả</a></li>
                    </ul>
                </div>


                <!-- Cột liên hệ -->
                <div class="col-md-3">
                    <h6 class="text-white mb-3">Liên hệ</h6>
                    <ul class="list-unstyled text-white-50 mb-0">
                        <li><i class="bi bi-telephone-fill me-2"></i>1900 1234</li>
                        <li><i class="bi bi-envelope-fill me-2"></i>info@techstore.com</li>
                        <li><i class="bi bi-geo-alt-fill me-2"></i>123 Đường ABC, Quận 1, TP.HCM</li>
                    </ul>
                    <a href="<?= BASE_URL ?>index.php?url=contact/index" class="btn btn-outline-primary">
    Liên hệ với chúng tôi
</a>

                </div>
            </div>
        </div>
    </div>

    <div class="ts-footer-bottom py-3">
        <div class="container d-flex flex-column flex-md-row justify-content-between text-white-50 small">
            <span>© <?= date('Y') ?> TechMart. Tất cả quyền được bảo lưu.</span>
            <span>
                <a href="#" class="ts-footer-link me-3">Chính sách bảo mật</a>
                <a href="#" class="ts-footer-link">Điều khoản sử dụng</a>
            </span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
