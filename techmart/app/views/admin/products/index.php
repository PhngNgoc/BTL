<h1 class="h3 mb-3">Quản lý sản phẩm</h1>

<div class="d-flex justify-content-between mb-3">
  <form class="d-flex" method="get">
    <input type="hidden" name="url" value="admin/product/index">
    <input class="form-control me-2" type="text" name="q" placeholder="Tìm kiếm..." 
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <button class="btn btn-outline-primary">Tìm kiếm</button>
  </form>

  <a href="<?= BASE_URL ?>index.php?url=admin/product/create" class="btn btn-primary">
    + Thêm sản phẩm
  </a>
</div>

<table class="table table-bordered align-middle">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tên</th>
      <th>Giá</th>
      <th>Tồn kho</th>
      <th>Trạng thái</th>
      <th style="width:150px;">Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= number_format($p['price']) ?> đ</td>
        <td><?= (int)$p['stock'] ?></td>
        <td><?= $p['status'] ?></td>
        <td>
          <a href="<?= BASE_URL ?>index.php?url=admin/product/edit/<?= $p['id'] ?>"
             class="btn btn-sm btn-secondary">Sửa</a>
          <a href="<?= BASE_URL ?>index.php?url=admin/product/delete/<?= $p['id'] ?>"
             class="btn btn-sm btn-danger"
             onclick="return confirm('Xoá sản phẩm này?');">Xoá</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
