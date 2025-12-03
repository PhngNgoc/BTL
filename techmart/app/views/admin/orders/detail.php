<h1 class="h3 mb-3">Chi tiết đơn hàng #<?= $order['id'] ?></h1>

<div class="row mb-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin khách hàng</h3>
      </div>
      <div class="card-body">
        <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['shipping_name']) ?></p>
        <p><strong>Điện thoại:</strong> <?= htmlspecialchars($order['shipping_phone']) ?></p>
        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
        <p><strong>Ngày tạo:</strong> <?= $order['created_at'] ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trạng thái đơn hàng</h3>
      </div>
      <div class="card-body">
        <form method="post" action="<?= BASE_URL ?>index.php?url=admin/order/updateStatus">
          <input type="hidden" name="id" value="<?= $order['id'] ?>">

          <div class="mb-3">
            <label class="form-label">Trạng thái hiện tại</label>
            <select name="status" class="form-select">
              <?php
              $statusList = ['pending' => 'pending',
                             'confirmed' => 'confirmed',
                             'shipping' => 'shipping',
                             'completed' => 'completed',
                             'cancelled' => 'cancelled'];
              foreach ($statusList as $key => $label):
              ?>
                <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>>
                  <?= $label ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
          <a href="<?= BASE_URL ?>index.php?url=admin/order/index"
             class="btn btn-outline-secondary ms-2">Quay lại</a>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách sản phẩm trong đơn</h3>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-vcenter">
        <thead>
          <tr>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $it): ?>
          <tr>
            <td><?= htmlspecialchars($it['name']) ?></td>
            <td><?= number_format($it['unit_price']) ?> đ</td>
            <td><?= $it['quantity'] ?></td>
            <td><?= number_format($it['total_price']) ?> đ</td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="text-end mt-3">
      <strong>Tổng tiền: <?= number_format($order['total_amount']) ?> đ</strong>
    </div>
  </div>
</div>
