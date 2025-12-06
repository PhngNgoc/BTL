<?php
session_start();

// Đường dẫn gốc đến thư mục app
define('APP_ROOT', dirname(__DIR__) . '/app/');
define('BASE_URL', '/techmart/public/');  // chỉnh lại nếu thư mục khác


// Đường dẫn tới thư mục public và uploads
define('PUBLIC_PATH', __DIR__ . '/');
define('UPLOAD_PATH', PUBLIC_PATH . 'assets/uploads/');       // đường dẫn trên server
define('UPLOAD_URL',  BASE_URL . 'assets/uploads/');          // link để hiển thị trên web

// Autoload 
require APP_ROOT . 'core/Database.php';
require APP_ROOT . 'core/Model.php';
require APP_ROOT . 'core/Controller.php';
require APP_ROOT . 'core/App.php';
// Khởi động ứng dụng (router)
$app = new App();
