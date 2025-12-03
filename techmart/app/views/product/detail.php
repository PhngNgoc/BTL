<?php
// Biến $p được truyền từ ProductController::detail()
?>

<div class="row">
  <div class="col-md-5 mb-3">
    <img src="<?= BASE_URL . 'assets/uploads/products/' . htmlspecialchars($p['thumbnail']) ?>"
         class="img-fluid rounded border"
         alt="<?= htmlspecialchars($p['name']) ?>">
  </div>

  <div class="col-md-7">
    <h1 class="h3 mb-3"><?= htmlspecialchars($p['name']) ?></h1>

    <p class="h4 text-danger fw-bold">
      <?= number_format($p['price']) ?> đ
    </p>

    <?php if (!empty($p['sale_price'])): ?>
      <p>
        <span class="text-muted text-decoration-line-through">
          <?= number_format($p['sale_price']) ?> đ
        </span>
        <span class="badge bg-success ms-2">Giảm giá</span>
      </p>
    <?php endif; ?>

    <?php if (!empty($p['short_desc'])): ?>
      <p class="mt-3">
        <?= nl2br(htmlspecialchars($p['short_desc'])) ?>
      </p>
    <?php endif; ?>

    <div class="mb-3">
      <span class="badge bg-secondary">
        Tồn kho: <?= (int)$p['stock'] ?> sản phẩm
      </span>
    </div>

    <!-- Form thêm vào giỏ hàng -->
    <form method="post" action="<?= BASE_URL ?>index.php?url=cart/add">
      <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">

      <div class="mb-3" style="max-width: 200px;">
        <label for="qty" class="form-label">Số lượng</label>
        <input type="number" id="qty" name="qty" class="form-control" value="1" min="1">
      </div>

      <button type="submit" class="btn btn-primary me-2">
        Thêm vào giỏ hàng
      </button>
      <a href="<?= BASE_URL ?>index.php?url=product/index" class="btn btn-outline-secondary">
        ← Quay lại danh sách
      </a>
    </form>
  </div>
</div>

<?php if (!empty($p['description'])): ?>
  <hr class="my-4">
  <h2 class="h5">Mô tả chi tiết</h2>
  <div class="mt-2">
    <?= nl2br(htmlspecialchars($p['description'])) ?>
  </div>
<?php endif; ?>
