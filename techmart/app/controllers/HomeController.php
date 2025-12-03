<?php

class HomeController extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');
        $featuredProducts = $productModel->getFeatured(4);

        $postModel = $this->model('Post');
        $latestPosts = $postModel->getLatest(3);

        $this->render('home/index', [
            'title'            => 'Trang chủ',
            'featuredProducts' => $featuredProducts,
            'latestPosts'      => $latestPosts
        ], 'layouts/main');
    }
}

