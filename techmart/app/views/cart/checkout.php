<h1 class="h3 mb-3">Thông tin đặt hàng</h1>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6">
    <form method="post" action="<?= BASE_URL ?>index.php?url=cart/checkout">
      <div class="mb-3">
        <label class="form-label">Họ tên người nhận</label>
        <input type="text" name="shipping_name" class="form-control"
               value="<?= htmlspecialchars($old['shipping_name'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input type="text" name="shipping_phone" class="form-control"
               value="<?= htmlspecialchars($old['shipping_phone'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Địa chỉ giao hàng</label>
        <textarea name="shipping_address" rows="3" class="form-control" required><?= htmlspecialchars($old['shipping_address'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
      <a href="<?= BASE_URL ?>index.php?url=cart/index" class="btn btn-outline-secondary ms-2">
        Quay lại giỏ hàng
      </a>
    </form>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tóm tắt đơn hàng</h3>
      </div>
      <div class="card-body">
        <ul class="list-group mb-3">
          <?php foreach ($cart as $item): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span>
                <?= htmlspecialchars($item['name']) ?> (x<?= $item['qty'] ?>)
              </span>
              <span><?= number_format($item['price'] * $item['qty']) ?> đ</span>
            </li>
          <?php endforeach; ?>
        </ul>
        <p class="h5 text-end">Tổng tiền: <span class="text-danger"><?= number_format($total) ?> đ</span></p>
      </div>
    </div>
  </div>
</div>
