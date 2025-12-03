<?php

class CommentAdminController extends Controller
{
    public function index()
    {
        $keyword      = $_GET['q'] ?? '';
        $commentModel = $this->model('PostComment');
        $comments     = $commentModel->getAll($keyword);

        $this->render('admin/comments/index', [
            'title'    => 'Quản lý bình luận',
            'comments' => $comments,
            'keyword'  => $keyword,
        ], 'layouts/admin');
    }

    public function approve($id)
    {
        $commentModel = $this->model('PostComment');
        $commentModel->updateApprove($id, 1);
        header('Location: ' . BASE_URL . 'index.php?url=admin/commentAdmin/index');
        exit;
    }

    public function unapprove($id)
    {
        $commentModel = $this->model('PostComment');
        $commentModel->updateApprove($id, 0);
        header('Location: ' . BASE_URL . 'index.php?url=admin/commentAdmin/index');
        exit;
    }

    public function delete($id)
    {
        $commentModel = $this->model('PostComment');
        $commentModel->delete($id);
        header('Location: ' . BASE_URL . 'index.php?url=admin/commentAdmin/index');
        exit;
    }
}
