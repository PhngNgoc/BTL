<?php

class SettingController extends Controller
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
        $all = $this->setting->getAll();

        $this->render(
            'admin/setting/index',
            [
                'title'      => 'Cấu hình website',
                'settings'   => $all,
                'activeMenu' => 'settings',
            ],
            'layouts/admin'
        );
    }

    public function update()
    {
        // Cập nhật từng key nhận được từ form
        $keys = ['site_name', 'company_phone', 'company_email', 'company_address', 'about_us'];

        foreach ($keys as $k) {
            if (isset($_POST[$k])) {
                $this->setting->set($k, $_POST[$k]);
            }
        }

        header("Location: " . BASE_URL . "index.php?url=admin/setting/index");
        exit;
    }
}
