<h1 class="h3 mb-4">Sửa sản phẩm</h1>

<form method="post" enctype="multipart/form-data"
      action="<?= BASE_URL ?>index.php?url=admin/product/update">

  <input type="hidden" name="id" value="<?= $p['id'] ?>">

  <div class="card">
    <div class="card-body">

      <div class="mb-3">
        <label class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" value="<?= htmlspecialchars($p['name']) ?>" class="form-control" required>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Giá</label>
          <input type="number" name="price" value="<?= $p['price'] ?>" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Tồn kho</label>
          <input type="number" name="stock" value="<?= $p['stock'] ?>" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Mô tả ngắn</label>
        <textarea name="short_desc" class="form-control" rows="2"><?= htmlspecialchars($p['short_desc']) ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Mô tả chi tiết</label>
        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($p['description']) ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh hiện tại</label><br>
        <img src="<?= BASE_URL . 'assets/uploads/products/' . $p['thumbnail'] ?>"
             style="width: 120px; border-radius: 8px;">
      </div>

      <div class="mb-3">
        <label class="form-label">Đổi ảnh mới (nếu có)</label>
        <input type="file" name="thumbnail" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-select">
          <option value="active"   <?= $p['status'] == 'active' ? 'selected' : '' ?>>active</option>
          <option value="inactive" <?= $p['status'] == 'inactive' ? 'selected' : '' ?>>inactive</option>
        </select>
      </div>

      <div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="<?= BASE_URL ?>index.php?url=admin/product/index"
           class="btn btn-outline-secondary ms-2">Hủy</a>
      </div>

    </div>
  </div>

</form>
