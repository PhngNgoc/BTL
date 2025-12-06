<div class="container py-4">
    <h1>Chỉnh sửa FAQ</h1>

    <form action="/admin/faq/update/<?= $faq['id'] ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Câu hỏi</label>
            <input type="text" name="question" class="form-control"
                   value="<?= $faq['question'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trả lời</label>
            <textarea name="answer" rows="5" class="form-control" required><?= $faq['answer'] ?></textarea>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
    </form>
</div>
