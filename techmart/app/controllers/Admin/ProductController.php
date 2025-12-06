<?php

class ProductController extends Controller
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
        $this->categoryModel = $this->model('Category'); 
    }

    // Danh sách + tìm kiếm
    public function index()
    {
        $keyword  = $_GET['q'] ?? '';
        $products = $this->productModel->getAll($keyword, null) ?? [];

        $this->render('admin/products/index', [
            'title'    => 'Quản lý sản phẩm',
            'products' => $products
        ], 'layouts/admin');   
    }

    // Form thêm mới
    public function create()
    {
        // Lấy danh sách loại sản phẩm
        $categories = $this->categoryModel->getAllActive();

        $this->render('admin/products/create', [
            'title'       => 'Thêm sản phẩm mới',
            'categories'  => $categories
        ], 'layouts/admin');
    }

    // Lưu sản phẩm mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=admin/product/index');
            exit;
        }

        $data = [
            'name'        => $_POST['name'] ?? '',
            'price'       => $_POST['price'] ?? 0,
            'short_desc'  => $_POST['short_desc'] ?? '',
            'description' => $_POST['description'] ?? '',
            'stock'       => $_POST['stock'] ?? 0,
            'status'      => $_POST['status'] ?? 'active',
            'thumbnail'   => null,
            'category_id' => (int)($_POST['category_id'] ?? 0),
        ];

        // upload ảnh 
        if (!empty($_FILES['thumbnail']['name'])) {
            $fileName = time() . '_' . basename($_FILES['thumbnail']['name']);
            $target   = __DIR__ . '/../../../public/assets/uploads/products/' . $fileName;
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = $fileName;
            }
        }

        $this->productModel->createSimple($data);

        header('Location: ' . BASE_URL . 'index.php?url=admin/product/index');
        exit;
    }

    // Form sửa
    public function edit($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        $p = $this->productModel->getById($id);
        if (!$p) die('Sản phẩm không tồn tại');

        $this->render('admin/products/edit', [
            'title' => 'Sửa sản phẩm',
            'p'     => $p
        ], 'layouts/admin');
    }

    // Cập nhật
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=admin/product/index');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $p  = $this->productModel->getById($id);
        if (!$p) die('Sản phẩm không tồn tại');

        $data = [
            'name'        => $_POST['name'] ?? '',
            'price'       => $_POST['price'] ?? 0,
            'short_desc'  => $_POST['short_desc'] ?? '',
            'description' => $_POST['description'] ?? '',
            'stock'       => $_POST['stock'] ?? 0,
            'status'      => $_POST['status'] ?? 'active',
            'thumbnail'   => $p['thumbnail'],
        ];

        if (!empty($_FILES['thumbnail']['name'])) {
            $fileName = time() . '_' . basename($_FILES['thumbnail']['name']);
            $target   = __DIR__ . '/../../../public/assets/uploads/products/' . $fileName;
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
                $data['thumbnail'] = $fileName;
            }
        }

        $this->productModel->updateSimple($id, $data);

        header('Location: ' . BASE_URL . 'index.php?url=admin/product/index');
        exit;
    }

    // Xoá
    public function delete($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if ($id) {
            $this->productModel->deleteSimple($id);
        }

        header('Location: ' . BASE_URL . 'index.php?url=admin/product/index');
        exit;
    }
}
