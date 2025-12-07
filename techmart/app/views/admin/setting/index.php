<div class="row row-cards">
    <div class="col-12">
        <form method="POST" action="<?= BASE_URL ?>index.php?url=admin/setting/update">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chung</h3>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Tên website</label>
                        <input type="text" name="site_name" class="form-control"
                               value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="company_phone" class="form-control"
                               value="<?= htmlspecialchars($settings['company_phone'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="company_email" class="form-control"
                               value="<?= htmlspecialchars($settings['company_email'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="company_address" class="form-control"
                               value="<?= htmlspecialchars($settings['company_address'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới thiệu (about us)</label>
                        <textarea name="about_us" rows="5" class="form-control"><?= htmlspecialchars($settings['about_us'] ?? '') ?></textarea>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </div>
</div>
