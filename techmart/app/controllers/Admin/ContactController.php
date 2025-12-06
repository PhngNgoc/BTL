<?php

class ContactController extends Controller
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = $this->model('Contact');
    }

    // danh sách liên hệ
    public function index()
    {
        $status   = $_GET['status'] ?? null;   // có thể lọc theo new/read/replied
        $contacts = $this->contactModel->getAll($status);

        $this->render('admin/contacts/index', [
            'title'    => 'Quản lý liên hệ',
            'contacts' => $contacts,
        ], 'layouts/admin');
    }

    // đánh dấu đã trả lời
    public function markReplied($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if ($id) {
            $this->contactModel->markReplied($id);
        }
        header('Location: ' . BASE_URL . 'index.php?url=admin/contact/index');
        exit;
    }

    // xoá liên hệ
    public function delete($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if ($id) {
            $this->contactModel->deleteById($id);
        }
        header('Location: ' . BASE_URL . 'index.php?url=admin/contact/index');
        exit;
    }
}
