<h1 class="h3 mb-4">Quản lý liên hệ</h1>

<?php if (!empty($contacts)): ?>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
      <tr>
        <th>#</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Chủ đề</th>
        <th>Ngày gửi</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($contacts as $c): ?>
        <tr>
          <td><?= (int)$c['id'] ?></td>
          <td><?= htmlspecialchars($c['name']) ?></td>
          <td><?= htmlspecialchars($c['email']) ?></td>
          <td><?= htmlspecialchars($c['phone']) ?></td>
          <td><?= htmlspecialchars($c['subject']) ?></td>
          <td><?= htmlspecialchars($c['created_at']) ?></td>
          <td>
            <?php if ($c['status'] === 'new'): ?>
              <span class="badge bg-warning">Mới</span>
            <?php elseif ($c['status'] === 'replied'): ?>
              <span class="badge bg-success">Đã trả lời</span>
            <?php else: ?>
              <span class="badge bg-secondary"><?= htmlspecialchars($c['status']) ?></span>
            <?php endif; ?>
          </td>
          <td>
              <!-- Nút xem chi tiết nội dung -->
            <a href="<?= BASE_URL ?>index.php?url=admin/contact/detail/<?= $c['id'] ?>"
              class="btn btn-sm btn-outline-primary">
              Xem
            </a>
            <?php if ($c['status'] !== 'replied'): ?>
              <a href="<?= BASE_URL ?>index.php?url=admin/contact/markReplied/<?= $c['id'] ?>"
                 class="btn btn-sm btn-outline-success">
                Đã trả lời
              </a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>index.php?url=admin/contact/delete/<?= $c['id'] ?>"
               class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Xóa liên hệ này?');">
              Xóa
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <p>Chưa có liên hệ nào.</p>
<?php endif; ?>
