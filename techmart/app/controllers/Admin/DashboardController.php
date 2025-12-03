// app/controllers/Admin/DashboardController.php
class DashboardController extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');
        $orderModel   = $this->model('Order');

        $totalProducts = $productModel->countAll();
        $totalOrders   = $orderModel->countAll();
        $pendingOrders = $orderModel->countByStatus('pending');

        $this->render('admin/dashboard/index', [
            'title'         => 'Dashboard',
            'activeMenu'    => 'dashboard',
            'totalProducts' => $totalProducts,
            'totalOrders'   => $totalOrders,
            'pendingOrders' => $pendingOrders,
        ], 'layouts/admin');
    }
}
