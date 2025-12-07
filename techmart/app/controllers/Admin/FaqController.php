<?php

class FaqController extends Controller
{
    private $faq;

    public function __construct()
    {
        if (method_exists($this, 'middleware')) {
            $this->middleware('auth:admin');
        }
        $this->faq = $this->model("Faq");
    }

    public function index()
    {
        $this->render(
            'admin/faq/index',
            [
                'title'      => 'Quản lý Hỏi/Đáp',
                'faqs'       => $this->faq->all(),
                'activeMenu' => 'faqs',
            ],
            'layouts/admin'          // ⬅️ quan trọng: layout admin
        );
    }

    public function create()
    {
        $this->render(
            'admin/faq/create',
            [
                'title'      => 'Thêm câu hỏi',
                'activeMenu' => 'faqs',
            ],
            'layouts/admin'
        );
    }

    public function edit($id)
    {
        $this->render(
            'admin/faq/edit',
            [
                'title'      => 'Chỉnh sửa câu hỏi',
                'faq'        => $this->faq->find($id),
                'activeMenu' => 'faqs',
            ],
            'layouts/admin'
        );
    }

    public function store()
    {
        $this->faq->create($_POST);
        header("Location: " . BASE_URL . "index.php?url=admin/faq/index");
        exit;
    }

    public function update($id)
    {
        $this->faq->updateFaq($id, $_POST);
        header("Location: " . BASE_URL . "index.php?url=admin/faq/index");
        exit;
    }

    public function delete($id)
    {
        $this->faq->deleteFaq($id);
        header("Location: " . BASE_URL . "index.php?url=admin/faq/index");
        exit;
    }
}
