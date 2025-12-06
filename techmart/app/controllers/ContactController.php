<?php

class ContactController extends Controller
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel = $this->model('Contact');
    }

    // Trang liên hệ cho user
    public function index()
    {
        $this->render('contact/index', [
            'title' => 'Liên hệ'
        ], 'layouts/main');    // tuỳ layout front của bạn
    }

    // Nhận submit form
    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=contact/index');
            exit;
        }

        $data = [
            'name'    => $_POST['name']    ?? '',
            'email'   => $_POST['email']   ?? '',
            'phone'   => $_POST['phone']   ?? '',
            'subject' => $_POST['subject'] ?? '',
            'message' => $_POST['message'] ?? '',
        ];

        $this->contactModel->create($data);

        $_SESSION['contact_success'] = 'Gửi liên hệ thành công!';
        header('Location: ' . BASE_URL . 'index.php?url=contact/index');
        exit;
    }
}
