<?php

class PostController extends Controller
{
    // Trang danh sách bài viết
    public function index()
    {
        $keyword   = $_GET['q'] ?? '';
        $postModel = $this->model('Post');
        $posts     = $postModel->getAll($keyword);

        $this->render('post/index', [
            'title' => 'Tin tức',
            'posts' => $posts,
            'keyword' => $keyword,
        ], 'layouts/main');
    }

    // Trang đọc bài viết
    public function detail($id)
    {
        $postModel    = $this->model('Post');
        $commentModel = $this->model('PostComment');

        $post = $postModel->getById($id);
        if (!$post || $post['status'] !== 'published') {
            die('Bài viết không tồn tại');
        }

        // xử lý gửi bình luận
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = trim($_POST['name'] ?? '');
            $email   = trim($_POST['email'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $rating  = (int)($_POST['rating'] ?? 0);

            if ($name && $content) {
                $commentModel->create([
                    'post_id'    => $post['id'],
                    'user_name'  => $name,
                    'user_email' => $email,
                    'content'    => $content,
                    'rating'     => $rating ?: null,
                ]);
                // reload để tránh gửi form lại
                header("Location: " . BASE_URL . "index.php?url=post/detail/" . $post['id']);
                exit;
            }
        }

        $comments = $commentModel->getByPost($post['id']);

        $this->render('post/detail', [
            'title'    => $post['title'],
            'post'     => $post,
            'comments' => $comments,
        ], 'layouts/main');
    }
}
