<h1 class="h3 mb-4">Tin tức</h1>

<form class="d-flex mb-4" method="get">
    <input type="hidden" name="url" value="post/index">
    <input type="text" class="form-control me-2" name="q"
           placeholder="Tìm kiếm bài viết..."
           value="<?= htmlspecialchars($keyword ?? '') ?>">
    <button class="btn btn-primary">Tìm kiếm</button>
</form>

<?php if (empty($posts)): ?>
    <p>Không có bài viết nào.</p>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <?php if (!empty($post['thumbnail'])): ?>
                        <img src="<?= BASE_URL ?>assets/uploads/posts/<?= htmlspecialchars($post['thumbnail']) ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($post['title']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                        <?php if (!empty($post['excerpt'])): ?>
                            <p class="card-text small text-muted">
                                <?= nl2br(htmlspecialchars($post['excerpt'])) ?>
                            </p>
                        <?php endif; ?>
                        <a href="<?= BASE_URL ?>index.php?url=post/detail/<?= $post['id'] ?>"
                           class="btn btn-outline-primary btn-sm">
                            Đọc bài viết
                        </a>
                    </div>
                    <div class="card-footer small text-muted">
                        <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
