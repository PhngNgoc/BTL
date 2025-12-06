<?php

class App
{
    protected $controller = 'ProductController'; // controller mặc định
    protected $method     = 'index';             // action mặc định
    protected $params     = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Xử lý controller (có hỗ trợ admin/)
        if (!empty($url[0]) && strtolower($url[0]) === 'admin') {
            // admin/product/index
            $controllerName = isset($url[1]) ? ucfirst($url[1]) . 'Controller' : 'DashboardController';
            $controllerFile = APP_ROOT . 'controllers/Admin/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require $controllerFile;
                $this->controller = $controllerName;
                $url = array_slice($url, 2); // bỏ 'admin' và tên controller
            }
        } else {
            // product/index
            if (!empty($url[0])) {
                $controllerName = ucfirst($url[0]) . 'Controller';
                $controllerFile = APP_ROOT . 'controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require $controllerFile;
                    $this->controller = $controllerName;
                    $url = array_slice($url, 1); // bỏ tên controller
                }
            }
        }

        // Khởi tạo controller
        if (!class_exists($this->controller)) {
            die("Controller {$this->controller} không tồn tại");
        }
        $this->controller = new $this->controller;

        // Xử lý method (action)
        if (!empty($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            $url = array_slice($url, 1);
        }

        // Phần còn lại là params
        $this->params = $url ? array_values($url) : [];

        // Gọi controller/action với tham số
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        // CONTACT FORM SUBMIT
if ($this->url == 'contact/submit') {
    require APP_ROOT . 'controllers/ContactController.php';
    (new ContactController())->submit();
    return;
}

// ADMIN - LIST CONTACTS
if ($this->url == 'admin/contacts') {
    require APP_ROOT . 'controllers/ContactController.php';
    (new ContactController())->index();
    return;
}

// ADMIN - MARK REPLIED
if (preg_match('/admin\/contacts\/reply\/(\d+)/', $this->url, $m)) {
    require APP_ROOT . 'controllers/ContactController.php';
    (new ContactController())->markReplied($m[1]);
    return;
}

// ADMIN - DELETE CONTACT
if (preg_match('/admin\/contacts\/delete\/(\d+)/', $this->url, $m)) {
    require APP_ROOT . 'controllers/ContactController.php';
    (new ContactController())->delete($m[1]);
    return;
}

        // mặc định: product/index
        return ['product', 'index'];
    }
}
