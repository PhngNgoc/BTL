<div class="container py-4">
    <h1>Chỉnh sửa trang Giới thiệu</h1>

    <form action="/admin/about/update" method="POST">
        <div class="mb-3">
            <label class="form-label">Nội dung giới thiệu</label>
            <textarea name="about_us" rows="10" class="form-control"><?= $about_us ?></textarea>
        </div>

        <button class="btn btn-primary">Lưu</button>
    </form>
</div>
