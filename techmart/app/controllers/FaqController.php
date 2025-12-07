<?php

class FaqController extends Controller
{
    private $faq;

    public function __construct()
    {
        $this->faq = $this->model("Faq");
    }

    public function index()
    {
        $faqs = $this->faq->all();

        // DÙNG render() để áp layout main.php
        $this->render('faq/index', [
            'title' => 'Hỏi & Đáp',
            'faqs'  => $faqs
        ]);
    }
}
