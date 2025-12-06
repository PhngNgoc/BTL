<div class="container py-4">
    <h1>Quản lý Hỏi/Đáp</h1>

    <a href="/admin/faq/create" class="btn btn-success mb-3">+ Thêm câu hỏi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Câu hỏi</th>
                <th>Trả lời</th>
                <th width="150">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faqs as $item): ?>
                <tr>
                    <td><?= $item['question'] ?></td>
                    <td><?= $item['answer'] ?></td>
                    <td>
                        <a href="/admin/faq/edit/<?= $item['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/admin/faq/delete/<?= $item['id'] ?>"
                           onclick="return confirm('Xoá câu hỏi này?')"
                           class="btn btn-danger btn-sm">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
