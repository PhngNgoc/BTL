<?php

class OrderController extends Controller
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');
    }

    // Danh sách đơn hàng
    public function index()
    {
        $orders = $this->orderModel->getAll();

        $this->render('admin/orders/index', [
            'title'  => 'Quản lý đơn hàng',
            'orders' => $orders
        ], 'layouts/admin');
    }

    // Chi tiết đơn hàng
    public function detail($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $order = $this->orderModel->getById($id);
        $items = $this->orderModel->getItems($id);

        $this->render('admin/orders/detail', [
            'title' => 'Chi tiết đơn hàng #' . $id,
            'order' => $order,
            'items' => $items
        ], 'layouts/admin');
    }

    // Cập nhật trạng thái
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id     = (int)$_POST['id'];
            $status = $_POST['status'] ?? 'pending';
            $this->orderModel->updateStatus($id, $status);
        }

        header('Location: ' . BASE_URL . 'index.php?url=admin/order/index');
        exit;
    }
}
