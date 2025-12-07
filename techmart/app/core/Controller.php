<?php

class Controller
{
    // Load model
    protected function model($model)
    {
        $file = APP_ROOT . 'models/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model();
        }
        throw new Exception("Model $model không tồn tại");
    }

    // Load view thuần (không layout)
    protected function view($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }
        require APP_ROOT . 'views/' . $view . '.php';
    }

    // Render view bên trong layout (dùng $content)
    protected function render($view, $data = [], $layout = 'layouts/main')
    {
        if (!empty($data)) {
            extract($data);  // có $title, $products,...
        }

        // view con
        ob_start();
        require APP_ROOT . 'views/' . $view . '.php';
        $content = ob_get_clean();

        // layout
        require APP_ROOT . 'views/' . $layout . '.php';
    }
    
}
