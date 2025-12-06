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
        $data['faqs'] = $this->faq->all();
        $this->view("faq/index", $data);
    }
}
