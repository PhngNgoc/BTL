<?php

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    // =================== ĐĂNG NHẬP ===================
    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $errors[] = "Vui lòng nhập đầy đủ thông tin.";
            } else {
                // Tìm user theo username
                $user = $this->userModel->findByUsername($username);

                if (!$user) {
                    $errors[] = "Tài khoản không tồn tại.";
                } elseif ($user['status'] === 'locked') {
                    $errors[] = "Tài khoản đã bị khóa.";
                } elseif (!password_verify($password, $user['password_hash'])) {
                    $errors[] = "Mật khẩu không đúng.";
                } else {
                    // Lưu session
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'full_name'=> $user['full_name'],
                        'role'     => $user['role']
                    ];

                    // Điều hướng
                    if ($user['role'] === 'admin') {
                        header("Location: " . BASE_URL . "index.php?url=admin/dashboard/index");
                    } else {
                        header("Location: " . BASE_URL . "index.php?url=home/index");
                    }
                    exit;
                }
            }
        }

        $this->render('auth/login', [
            'title' => 'Đăng nhập',
            'errors' => $errors
        ], 'layouts/main');
    }

    // =================== ĐĂNG KÝ ===================
    public function register()
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username   = trim($_POST['username'] ?? '');
            $email      = trim($_POST['email'] ?? '');
            $full_name  = trim($_POST['full_name'] ?? '');
            $password   = $_POST['password'] ?? '';
            $confirm    = $_POST['confirm_password'] ?? '';

            $old = compact('username', 'email', 'full_name');

            if ($username === '' || $email === '' || $password === '') {
                $errors[] = "Vui lòng nhập đầy đủ thông tin.";
            } elseif ($password !== $confirm) {
                $errors[] = "Mật khẩu xác nhận không khớp.";
            } elseif ($this->userModel->findByUsername($username)) {
                $errors[] = "Username đã tồn tại.";
            } elseif ($this->userModel->findByEmail($email)) {
                $errors[] = "Email đã tồn tại.";
            } else {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $this->userModel->create([
                    'username'      => $username,
                    'email'         => $email,
                    'full_name'     => $full_name,
                    'password_hash' => $password_hash,
                    'role'          => 'user'
                ]);

                $_SESSION['flash_success'] = "Đăng ký thành công! Hãy đăng nhập.";
                header("Location: " . BASE_URL . "index.php?url=auth/login");
                exit;
            }
        }

        $this->render('auth/register', [
            'title' => 'Đăng ký',
            'errors'=> $errors,
            'old'   => $old
        ], 'layouts/main');
    }

    // =================== ĐĂNG XUẤT ===================
    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: " . BASE_URL . "index.php?url=home/index");
        exit;
    }
}
