<h1 class="h3 mb-3">Đặt hàng thành công</h1>

<div class="alert alert-success">
  Cảm ơn bạn đã đặt hàng tại TechMart!
</div>

<p>Mã đơn hàng của bạn: <strong>#<?= htmlspecialchars($orderId) ?></strong></p>

<a href="<?= BASE_URL ?>index.php" class="btn btn-primary mt-2">
  Về trang chủ
</a>
<a href="<?= BASE_URL ?>index.php?url=product/index" class="btn btn-outline-secondary mt-2 ms-2">
  Tiếp tục mua sắm
</a>
