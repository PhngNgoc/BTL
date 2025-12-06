<h1 class="h3 mb-4">Thêm sản phẩm mới</h1>

<form method="post" enctype="multipart/form-data"
      action="<?= BASE_URL ?>index.php?url=admin/product/store">

  <div class="card">
    <div class="card-body">

      <div class="mb-3">
        <label class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Giá</label>
          <input type="number" name="price" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Tồn kho</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
      </div>

      <!-- CHỌN LOẠI SẢN PHẨM -->
      <div class="mb-3">
        <label class="form-label">Danh mục sản phẩm</label>
        <select name="category_id" class="form-select" required>
          <option value="">-- Chọn danh mục --</option>
          <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
              <option value="<?= $cat['id'] ?>">
                  <?= htmlspecialchars($cat['name']) ?>
              </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <!-- HẾT CHỌN LOẠI -->

      <div class="mb-3">
        <label class="form-label">Mô tả ngắn</label>
        <textarea name="short_desc" class="form-control" rows="2"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Mô tả chi tiết</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" class="form-control" name="thumbnail" accept="image/*">
      </div>

      <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-select">
          <option value="active">active</option>
          <option value="inactive">inactive</option>
        </select>
      </div>

      <div>
        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        <a href="<?= BASE_URL ?>index.php?url=admin/product/index"
           class="btn btn-outline-secondary ms-2">Hủy</a>
      </div>
    </div>
  </div>

</form>
