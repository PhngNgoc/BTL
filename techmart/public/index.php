<?php
session_start();

// Đường dẫn gốc đến thư mục app
define('APP_ROOT', dirname(__DIR__) . '/app/');
define('BASE_URL', '/techmart/public/');  // chỉnh lại nếu thư mục khác

// Autoload rất đơn giản
require APP_ROOT . 'core/Database.php';
require APP_ROOT . 'core/Model.php';
require APP_ROOT . 'core/Controller.php';
require APP_ROOT . 'core/App.php';

// Khởi động ứng dụng (router)
$app = new App();
