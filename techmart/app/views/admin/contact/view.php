<h2>Chi tiết liên hệ</h2>

<p><strong>Họ tên:</strong> <?= htmlspecialchars($contact['name']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($contact['email']) ?></p>
<p><strong>SĐT:</strong> <?= htmlspecialchars($contact['phone']) ?></p>
<p><strong>Tiêu đề:</strong> <?= htmlspecialchars($contact['subject']) ?></p>
<p><strong>Nội dung:</strong> <?= nl2br(htmlspecialchars($contact['message'])) ?></p>

<a href="<?= BASE_URL ?>admin/contacts" class="btn btn-secondary mt-3">Quay lại</a>
