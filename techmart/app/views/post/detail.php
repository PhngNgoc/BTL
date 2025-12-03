<article class="mb-5">
    <h1 class="h3 mb-3"><?= htmlspecialchars($post['title']) ?></h1>
    <p class="text-muted small mb-3">
        Ngày đăng: <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
    </p>

    <?php if (!empty($post['thumbnail'])): ?>
        <img src="<?= BASE_URL ?>assets/uploads/posts/<?= htmlspecialchars($post['thumbnail']) ?>"
             class="img-fluid rounded mb-4"
             alt="<?= htmlspecialchars($post['title']) ?>">
    <?php endif; ?>

    <div class="post-content">
        <?= nl2br($post['content']) ?>
    </div>
</article>

<hr>

<section class="mb-4">
    <h5 class="mb-3">Bình luận</h5>

    <?php foreach ($comments as $c): ?>
        <div class="mb-3">
            <strong><?= htmlspecialchars($c['user_name']) ?></strong>
            <span class="text-muted small">
                • <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
            </span>
            <?php if (!empty($c['rating'])): ?>
                <span class="text-warning ms-2">
                    <?= str_repeat('★', (int)$c['rating']) ?>
                </span>
            <?php endif; ?>
            <p class="mb-0"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
        </div>
    <?php endforeach; ?>

    <?php if (empty($comments)): ?>
        <p class="text-muted">Chưa có bình luận nào.</p>
    <?php endif; ?>
</section>

<section>
    <h5 class="mb-3">Viết bình luận</h5>
    <form method="post">
        <div class="mb-2">
            <label class="form-label">Tên *</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Đánh giá (1–5 sao)</label>
            <select name="rating" class="form-select">
                <option value="">Không đánh giá</option>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?> ★</option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung *</label>
            <textarea name="content" rows="3" class="form-control" required></textarea>
        </div>
        <button class="btn btn-primary">Gửi bình luận</button>
    </form>
</section>
