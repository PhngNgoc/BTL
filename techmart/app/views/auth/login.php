<div class="container py-5">
    <h2 class="text-center mb-4">Đăng nhập</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <div><?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= BASE_URL ?>index.php?url=auth/login">
        <div class="mb-3">
            <label class="form-label">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Đăng nhập</button>

        <p class="mt-3 text-center">
            Chưa có tài khoản?
            <a href="<?= BASE_URL ?>index.php?url=auth/register">Đăng ký</a>
        </p>
    </form>
</div>
