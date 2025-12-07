<?php

class App
{
    protected $controller = 'ProductController'; // controller mặc định
    protected $method     = 'index';             // action mặc định
    protected $params     = [];

    public function __construct()
    {
        $url = $this->parseUrl(); // luôn là mảng

        // --- XỬ LÝ CONTROLLER ---

        // admin/xxx/...
        if (!empty($url[0]) && strtolower($url[0]) === 'admin') {
            // admin/product/index  => controllers/Admin/ProductController.php
            $controllerName = isset($url[1]) ? ucfirst($url[1]) . 'Controller' : 'DashboardController';
            $controllerFile = APP_ROOT . 'controllers/Admin/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require $controllerFile;
                $this->controller = $controllerName;
                $url = array_slice($url, 2); // bỏ 'admin' và tên controller
            }
        } else {
            // product/index => controllers/ProductController.php
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

        // --- KHỞI TẠO CONTROLLER ---
        if (!class_exists($this->controller)) {
            die("Controller {$this->controller} không tồn tại");
        }
        $this->controller = new $this->controller;

        // --- XỬ LÝ METHOD (ACTION) ---
        if (!empty($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            $url = array_slice($url, 1);
        }

        // --- PARAMS ---
        $this->params = $url ? array_values($url) : [];

        // --- GỌI CONTROLLER/ACTION ---
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url']) && $_GET['url'] !== '') {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        // Không có ?url= → mặc định về trang sản phẩm (hoặc home tuỳ bạn)
        return ['product', 'index'];
        // nếu muốn về trang chủ: return ['home', 'index'];
    }
}
