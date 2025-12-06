<!-- app/views/home/index.php -->

<!-- HERO SECTION -->
<section class="ts-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 class="ts-hero-title mb-3">
                    Khám phá bộ sưu tập công nghệ hàng đầu
                </h1>
                <p class="ts-hero-text mb-4">
                    Khám phá bộ sưu tập công nghệ hàng đầu với chất lượng cao,
                    giá cả hợp lý và dịch vụ tuyệt vời.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?= BASE_URL ?>index.php?url=product/index"
                       class="btn btn-primary ts-btn-pill">
                        Mua ngay
                    </a>
                    <a href="<?= BASE_URL ?>index.php?url=product/index"
                       class="btn btn-outline-light ts-btn-pill">
                        Xem sản phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Ảnh hero: bạn đổi src sang ảnh thật -->
                <div class="ts-hero-image rounded-4 overflow-hidden">
                    <img src="<?= BASE_URL ?>assets/img/hero-laptop.jpg"
                         alt="Laptop"
                         class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES SECTION -->
<section class="py-5 ts-section-light">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div class="text-center text-md-start">
                <h2 class="ts-section-title mb-1">Danh Mục Sản Phẩm</h2>
                <p class="ts-section-subtitle mb-0">
                    Tìm hiểu các sản phẩm công nghệ hàng đầu
                </p>
            </div>

            <!-- Nút truy cập danh sách sản phẩm -->
            <a href="<?= BASE_URL ?>index.php?url=product/index"
               class="btn btn-outline-primary ts-btn-pill mt-3 mt-md-0">
                Xem tất cả sản phẩm →
            </a>
        </div>


        <div class="row g-4">
            <?php
            $categories = [
                ['id' => 2, 'icon' => 'bi-phone',      'name' => 'Điện thoại', 'desc' => 'Smartphone cao cấp từ các thương hiệu hàng đầu'],
                ['id' => 1, 'icon' => 'bi-laptop',     'name' => 'Laptop',     'desc' => 'Máy tính xách tay hiệu năng cao cho mọi nhu cầu'],
                ['id' => 4, 'icon' => 'bi-headphones', 'name' => 'Tai nghe',   'desc' => 'Âm thanh chất lượng cao với công nghệ tiên tiến'],
                ['id' => 3, 'icon' => 'bi-lightning',  'name' => 'Phụ kiện',   'desc' => 'Phụ kiện công nghệ đa dạng và tiện ích'],
            ];

            foreach ($categories as $cat): ?>
                <div class="col-md-3">
                    <div class="ts-category-card">
                        <div class="ts-category-icon mb-3">
                            <i class="bi <?= $cat['icon'] ?>"></i>
                        </div>
                        <h5 class="mb-2"><?= $cat['name'] ?></h5>
                        <p class="mb-3 text-muted small"><?= $cat['desc'] ?></p>
                        <a href="<?= BASE_URL ?>index.php?url=product/index&category=<?= $cat['id'] ?>"
                        class="ts-link-arrow">
                        Xem thêm <span class="ms-1">→</span>
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="container my-5">
    <!-- TIN TỨC MỚI NHẤT -->
    <?php if (!empty($latestPosts)): ?>
        <div class="mt-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Tin tức mới nhất</h3>
            </div>

            <div class="row g-4">
                <?php foreach ($latestPosts as $post): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm rounded-4 border-0 h-100 p-3">
                            <img src="<?= BASE_URL ?>assets/uploads/posts/<?= htmlspecialchars($post['thumbnail']) ?>"
                                 alt="<?= htmlspecialchars($post['title']) ?>"
                                 class="img-fluid rounded-3 mb-3"
                                 style="height:180px; object-fit:cover;">

                            <h5 class="fw-semibold">
                                <?= htmlspecialchars($post['title']) ?>
                            </h5>
                            <p class="text-muted small mb-3">
                                <?= htmlspecialchars($post['excerpt']) ?>
                            </p>

                            <a href="<?= BASE_URL ?>index.php?url=post/detail/<?= $post['id'] ?>"
                               class="btn btn-outline-primary w-100 rounded-3">
                                Đọc bài viết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</section>
