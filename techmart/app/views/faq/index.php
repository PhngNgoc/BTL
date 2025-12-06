<div class="container py-4">
    <h1 class="mb-3">Hỏi & Đáp</h1>
    <hr>

    <?php if (!empty($faqs)): ?>
        <?php foreach ($faqs as $item): ?>
            <div class="mb-3">
                <h5 class="fw-bold"><?= $item['question'] ?></h5>
                <p><?= $item['answer'] ?></p>
                <hr>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Hiện chưa có câu hỏi nào.</p>
    <?php endif; ?>
</div>
