<div class="container py-5">
    <h2 class="text-center mb-4">Đăng ký</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <div><?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= BASE_URL ?>index.php?url=auth/register">
        <div class="mb-3">
            <label class="form-label">Tên đăng nhập *</label>
            <input type="text" name="username" class="form-control"
                   value="<?= htmlspecialchars($old['username'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input type="text" name="full_name" class="form-control"
                   value="<?= htmlspecialchars($old['full_name'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu *</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu *</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Đăng ký</button>

        <p class="mt-3 text-center">
            Đã có tài khoản?
            <a href="<?= BASE_URL ?>index.php?url=auth/login">Đăng nhập</a>
        </p>
    </form>
</div>
