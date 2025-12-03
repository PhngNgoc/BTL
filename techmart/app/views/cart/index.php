<?php
// $cart và $total được truyền từ CartController::index()
?>

<h1 class="h3 mb-3">Giỏ hàng</h1>

<?php if (empty($cart)): ?>
    <p>Giỏ hàng của bạn đang trống.</p>
    <a href="<?= BASE_URL ?>index.php?url=product/index" class="btn btn-primary">
        Tiếp tục mua sắm
    </a>
<?php else: ?>

<form method="post" action="<?= BASE_URL ?>index.php?url=cart/index">
  <div class="table-responsive mb-3">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Sản phẩm</th>
          <th>Đơn giá</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart as $item): ?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img src="<?= BASE_URL . 'assets/uploads/products/' . htmlspecialchars($item['thumbnail']) ?>"
                     alt="<?= htmlspecialchars($item['name']) ?>"
                     style="width:60px; height:60px; object-fit:cover;" class="me-3 rounded">
                <span><?= htmlspecialchars($item['name']) ?></span>
              </div>
            </td>
            <td><?= number_format($item['price']) ?> đ</td>
            <td style="max-width: 100px;">
              <input type="number"
                     name="qty[<?= $item['id'] ?>]"
                     value="<?= (int)$item['qty'] ?>"
                     min="1"
                     class="form-control">
            </td>
            <td><?= number_format($item['price'] * $item['qty']) ?> đ</td>
            <td>
              <a href="<?= BASE_URL . 'index.php?url=cart/remove/' . $item['id'] ?>"
                 class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Xóa sản phẩm này khỏi giỏ?');">
                Xóa
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <div>
      <a href="<?= BASE_URL ?>index.php?url=product/index" class="btn btn-outline-secondary">
        ← Tiếp tục mua sắm
      </a>
      <a href="<?= BASE_URL ?>index.php?url=cart/clear"
         class="btn btn-outline-danger ms-2"
         onclick="return confirm('Xóa toàn bộ giỏ hàng?');">
        Xóa giỏ hàng
      </a>
    </div>

    <div class="text-end">
      <p class="mb-1">Tổng tiền:</p>
      <p class="h4 text-danger"><?= number_format($total) ?> đ</p>

      <button type="submit" class="btn btn-primary mt-2">
        Cập nhật giỏ hàng
      </button>

      <a href="<?= BASE_URL ?>index.php?url=cart/checkout"
         class="btn btn-success mt-2 ms-2">
        Tiến hành đặt hàng
      </a>
    </div>
  </div>
</form>

<?php endif; ?>
