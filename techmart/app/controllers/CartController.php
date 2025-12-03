<?php

class CartController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ===== HIỂN THỊ GIỎ HÀNG =====
public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Nếu bấm "Cập nhật giỏ hàng"
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['qty']) && is_array($_POST['qty'])) {
                foreach ($_POST['qty'] as $productId => $qty) {
                    $productId = (int)$productId;
                    $qty       = max(1, (int)$qty);  // không cho < 1

                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['qty'] = $qty;
                    }
                }
            }

            // redirect để tránh F5 gửi lại form
            header('Location: ' . BASE_URL . 'index.php?url=cart/index');
            exit;
        }

        // Hiển thị giỏ hàng
        $cart  = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $this->render('cart/index', [
            'title' => 'Giỏ hàng',
            'cart'  => $cart,
            'total' => $total,
        ]);
    }

    // ===== THÊM VÀO GIỎ =====
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=cart/index');
            exit;
        }

        $id  = (int)($_POST['id'] ?? 0);
        $qty = (int)($_POST['qty'] ?? 1);
        if ($qty < 1) $qty = 1;

        if (!$id) {
            header('Location: ' . BASE_URL . 'index.php?url=product/index');
            exit;
        }

        // Lấy thông tin sản phẩm từ Model
        $productModel = $this->model('Product');
        $p = $productModel->getById($id);
        if (!$p) {
            header('Location: ' . BASE_URL . 'index.php?url=product/index');
            exit;
        }

        // Khởi tạo giỏ
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Nếu sản phẩm đã có trong giỏ → cộng số lượng
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id'        => $p['id'],
                'name'      => $p['name'],
                'price'     => $p['price'],
                'thumbnail' => $p['thumbnail'],
                'qty'       => $qty
            ];
        }

        // Chuyển tới trang giỏ hàng
        header('Location: ' . BASE_URL . 'index.php?url=cart/index');
        exit;
    }

    // ===== CẬP NHẬT SỐ LƯỢNG =====
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['qty'])) {
            foreach ($_POST['qty'] as $id => $q) {
                $id = (int)$id;
                $q  = (int)$q;
                if ($q <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    $_SESSION['cart'][$id]['qty'] = $q;
                }
            }
        }

        header('Location: ' . BASE_URL . 'index.php?url=cart/index');
        exit;
    }

    // ===== XOÁ 1 MÓN TRONG GIỎ =====
    public function remove($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        header('Location: ' . BASE_URL . 'index.php?url=cart/index');
        exit;
    }

    // ===== XOÁ TẤT CẢ GIỎ =====
    public function clear()
    {
        unset($_SESSION['cart']);
        header('Location: ' . BASE_URL . 'index.php?url=cart/index');
        exit;
    }

    public function checkout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) {
        // Không có gì trong giỏ -> quay lại giỏ hàng
        header('Location: ' . BASE_URL . 'index.php?url=cart/index');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Hiển thị form nhập thông tin giao hàng
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $this->render('cart/checkout', [
            'title' => 'Đặt hàng',
            'cart'  => $cart,
            'total' => $total
        ]);
    } else {
        // Xử lý submit form (POST)
        $name    = trim($_POST['shipping_name'] ?? '');
        $phone   = trim($_POST['shipping_phone'] ?? '');
        $address = trim($_POST['shipping_address'] ?? '');

        $errors = [];
        if ($name === '')    $errors[] = 'Vui lòng nhập họ tên';
        if ($phone === '')   $errors[] = 'Vui lòng nhập số điện thoại';
        if ($address === '') $errors[] = 'Vui lòng nhập địa chỉ giao hàng';

        if (!empty($errors)) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['qty'];
            }

            $this->render('cart/checkout', [
                'title'  => 'Đặt hàng',
                'cart'   => $cart,
                'total'  => $total,
                'errors' => $errors,
                'old'    => [
                    'shipping_name'    => $name,
                    'shipping_phone'   => $phone,
                    'shipping_address' => $address,
                ]
            ]);
            return;
        }

        // Tạo đơn hàng qua Order model
        $orderModel = $this->model('Order');

        $info = [
            'user_id'          => $_SESSION['user']['id'] ?? null,
            'shipping_name'    => $name,
            'shipping_phone'   => $phone,
            'shipping_address' => $address,
        ];

        $orderId = $orderModel->createFromCart($info, $cart);

        // Xoá giỏ hàng
        unset($_SESSION['cart']);

        // Chuyển sang trang hoàn tất
        header('Location: ' . BASE_URL . 'index.php?url=cart/complete&order_id=' . $orderId);
        exit;
    }
}

public function complete()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $orderId = $_GET['order_id'] ?? null;

    $this->render('cart/complete', [
        'title'   => 'Đặt hàng thành công',
        'orderId' => $orderId
    ]);
}

}
