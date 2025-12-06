<?php

class AboutController extends Controller
{
    private $setting;

    public function __construct()
    {
        // nếu bạn có middleware check admin thì giữ lại, không thì bỏ
        if (method_exists($this, 'middleware')) {
            $this->middleware("auth:admin");
        }

        $this->setting = $this->model("Setting");
    }

    public function index()
    {
        $data['about_us'] = $this->setting->get('about_us');
        $this->view("admin/about/edit", $data);
    }

    public function update()
    {
        if (isset($_POST['about_us'])) {
            $this->setting->set('about_us', $_POST['about_us']);
        }
        // tuỳ router của bạn: /admin/about hoặc giống vậy
        header("Location: /admin/about");
        exit;
    }
}
