<?php

class ProductController extends Controller
{
    public function index()
    {
        $keyword  = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? null;

        $productModel = $this->model("Product");
        $products = $productModel->getAll($keyword, $category) ?? [];

        $this->render('product/index', [
            'title'    => 'Danh sách sản phẩm',
            'products' => $products
        ]);
    }

    // ===== TRANG CHI TIẾT SẢN PHẨM =====
    public function detail($id = null)
    {
        // Cho phép /product/detail/5 hoặc ?id=5
        if ($id === null && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }

        if (!$id) {
            die('Thiếu tham số sản phẩm.');
        }

        $productModel = $this->model("Product");
        $p = $productModel->getById($id);

        if (!$p) {
            die('Sản phẩm không tồn tại.');
        }

        $this->render('product/detail', [
            'title' => $p['name'],
            'p'     => $p
        ]);
    }
}
