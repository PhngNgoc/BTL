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

        $this->render('admin/contact/index', [
            'title'      => 'Quản lý liên hệ',
            'contacts'   => $contacts,
            'activeMenu' => 'contacts',
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

    // 👉 Xem chi tiết liên hệ
    public function detail($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if (!$id) {
            die('Thiếu id liên hệ');
        }

        $contact = $this->contactModel->getById($id);
        if (!$contact) {
            die('Liên hệ không tồn tại');
        }

        $this->render(
            'admin/contact/view',
            [
                'title'      => 'Chi tiết liên hệ',
                'contact'    => $contact,
                'activeMenu' => 'contacts',
            ],
            'layouts/admin'
        );
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
