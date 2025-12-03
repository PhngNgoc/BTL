<h1 class="h3 mb-3">Quản lý đơn hàng</h1>

<table class="table table-bordered align-middle">
  <thead>
    <tr>
      <th>ID</th>
      <th>Khách hàng</th>
      <th>Tổng tiền</th>
      <th>Trạng thái</th>
      <th>Ngày tạo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $o): ?>
      <tr>
        <td>#<?= $o['id'] ?></td>
        <td><?= htmlspecialchars($o['shipping_name']) ?></td>
        <td><?= number_format($o['total_amount']) ?> đ</td>
        <td><?= $o['status'] ?></td>
        <td><?= $o['created_at'] ?></td>
        <td>
          <a href="<?= BASE_URL ?>index.php?url=admin/order/detail/<?= $o['id'] ?>"
             class="btn btn-sm btn-primary">Xem</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
