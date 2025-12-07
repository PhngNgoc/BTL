<?php

class AboutController extends Controller
{
    private $setting;

    public function __construct()
    {
        if (method_exists($this, 'middleware')) {
            $this->middleware('auth:admin');
        }
        $this->setting = $this->model("Setting");
    }

    public function index()
    {
        $this->render(
            'admin/about/edit',
            [
                'title'      => 'Quản lý trang Giới thiệu',
                'about_us'   => $this->setting->get('about_us'),
                'activeMenu' => 'about',
            ],
            'layouts/admin'          // ⬅️ layout admin
        );
    }

    public function update()
    {
        if (isset($_POST['about_us'])) {
            $this->setting->set('about_us', $_POST['about_us']);
        }

        header("Location: " . BASE_URL . "index.php?url=admin/about/index");
        exit;
    }
}
