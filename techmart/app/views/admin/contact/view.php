<h1 class="h3 mb-4">Chi tiết liên hệ #<?= (int)$contact['id'] ?></h1>

<div class="card">
  <div class="card-body">
    <dl class="row mb-0">
      <dt class="col-sm-3">Họ tên</dt>
      <dd class="col-sm-9"><?= htmlspecialchars($contact['name']) ?></dd>

      <dt class="col-sm-3">Email</dt>
      <dd class="col-sm-9"><?= htmlspecialchars($contact['email']) ?></dd>

      <dt class="col-sm-3">Điện thoại</dt>
      <dd class="col-sm-9"><?= htmlspecialchars($contact['phone']) ?></dd>

      <dt class="col-sm-3">Chủ đề</dt>
      <dd class="col-sm-9"><?= htmlspecialchars($contact['subject']) ?></dd>

      <dt class="col-sm-3">Ngày gửi</dt>
      <dd class="col-sm-9"><?= htmlspecialchars($contact['created_at']) ?></dd>

      <dt class="col-sm-3">Trạng thái</dt>
      <dd class="col-sm-9">
        <?= htmlspecialchars($contact['status']) ?>
      </dd>

      <dt class="col-sm-3">Nội dung</dt>
      <dd class="col-sm-9">
        <pre class="mb-0"><?= htmlspecialchars($contact['message']) ?></pre>
      </dd>
    </dl>
  </div>
  <div class="card-footer d-flex justify-content-between">
    <a href="<?= BASE_URL ?>index.php?url=admin/contact/index"
       class="btn btn-secondary">
      ← Quay lại danh sách
    </a>

    <div>
      <?php if ($contact['status'] !== 'replied'): ?>
        <a href="<?= BASE_URL ?>index.php?url=admin/contact/markReplied/<?= $contact['id'] ?>"
           class="btn btn-success">
          Đánh dấu đã trả lời
        </a>
      <?php endif; ?>
      <a href="<?= BASE_URL ?>index.php?url=admin/contact/delete/<?= $contact['id'] ?>"
         class="btn btn-danger"
         onclick="return confirm('Xóa liên hệ này?');">
        Xóa liên hệ
      </a>
    </div>
  </div>
</div>
