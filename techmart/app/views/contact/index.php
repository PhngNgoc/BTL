<div class="container py-5">
    <h1 class="mb-4 text-center">Liên hệ</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php
    $old = $_SESSION['old'] ?? [];
    unset($_SESSION['old']);
    ?>

    <form method="post" action="<?= BASE_URL ?>index.php?url=contact/send" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Họ tên *</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($old['name'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($old['email'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control"
                   value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label">Tiêu đề *</label>
            <input type="text" name="subject" class="form-control"
                   value="<?= htmlspecialchars($old['subject'] ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label">Nội dung *</label>
            <textarea name="message" rows="5" class="form-control"><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary px-4">Gửi liên hệ</button>
        </div>
    </form>
</div>
