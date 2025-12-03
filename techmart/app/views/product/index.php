<h1 class="h3 mb-3">Danh sách sản phẩm</h1>

<form class="d-flex mb-4" method="get">
    <input class="form-control me-2" type="text" name="q" 
           placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
</form>

<div class="row g-4">
<?php foreach ($products as $p): ?>
    <div class="col-md-4 col-lg-3">
        <div class="product-card shadow-sm rounded-4 p-3">
            <img class="product-img"
                 src="<?= BASE_URL ?>assets/uploads/products/<?= htmlspecialchars($p['thumbnail']) ?>"
                 alt="<?= htmlspecialchars($p['name']) ?>">

            <h5 class="mt-3 fw-semibold"><?= htmlspecialchars($p['name']) ?></h5>

            <p class="text-danger fw-bold fs-5">
                <?= number_format($p['price']) ?> đ
            </p>

            <a href="<?= BASE_URL ?>index.php?url=product/detail/<?= $p['id'] ?>"
               class="btn btn-outline-primary w-100 rounded-3 mt-2">
                Xem chi tiết
            </a>
        </div>
    </div>
<?php endforeach; ?>
</div>

