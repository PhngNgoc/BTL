<?php

class PostAdminController extends Controller
{
    // danh sách bài viết
    public function index()
    {
        $keyword   = $_GET['q'] ?? '';
        $postModel = $this->model('Post');
        $posts     = $postModel->getAllAdmin($keyword);

        $this->render('admin/posts/index', [
            'title' => 'Quản lý tin tức',
            'posts' => $posts,
            'keyword' => $keyword,
        ], 'layouts/admin');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'     => $_POST['title'],
                'slug'      => $_POST['slug'] ?: $this->slugify($_POST['title']),
                'excerpt'   => $_POST['excerpt'] ?? '',
                'content'   => $_POST['content'],
                'thumbnail' => $_POST['thumbnail'] ?? '', // hoặc xử lý upload file
                'status'    => $_POST['status'] ?? 'draft',
            ];

            $postModel = $this->model('Post');
            $postModel->create($data);

            header('Location: ' . BASE_URL . 'index.php?url=admin/postAdmin/index');
            exit;
        }

        $this->render('admin/posts/form', [
            'title' => 'Thêm bài viết',
            'post'  => null,
        ], 'layouts/admin');
    }

    public function edit($id)
    {
        $postModel = $this->model('Post');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'     => $_POST['title'],
                'slug'      => $_POST['slug'] ?: $this->slugify($_POST['title']),
                'excerpt'   => $_POST['excerpt'] ?? '',
                'content'   => $_POST['content'],
                'thumbnail' => $_POST['thumbnail'] ?? '',
                'status'    => $_POST['status'] ?? 'draft',
            ];
            $postModel->update($id, $data);

            header('Location: ' . BASE_URL . 'index.php?url=admin/postAdmin/index');
            exit;
        }

        $post = $postModel->getById($id);
        $this->render('admin/posts/form', [
            'title' => 'Sửa bài viết',
            'post'  => $post,
        ], 'layouts/admin');
    }

    public function delete($id)
    {
        $postModel = $this->model('Post');
        $postModel->delete($id);

        header('Location: ' . BASE_URL . 'index.php?url=admin/postAdmin/index');
        exit;
    }

    private function slugify($str)
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace('/[^a-z0-9\s-]/u', '', $str);
        $str = preg_replace('/\s+/', '-', $str);
        return trim($str, '-');
    }
}
