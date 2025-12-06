<div class="container py-4">
    <h1>Thêm câu hỏi mới</h1>

    <form action="/admin/faq/store" method="POST">
        <div class="mb-3">
            <label class="form-label">Câu hỏi</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trả lời</label>
            <textarea name="answer" rows="5" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success">Lưu</button>
    </form>
</div>
