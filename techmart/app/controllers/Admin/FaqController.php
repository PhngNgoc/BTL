<?php

class FaqController extends Controller
{
    private $faq;

    public function __construct()
    {
        if (method_exists($this, 'middleware')) {
            $this->middleware("auth:admin");
        }

        $this->faq = $this->model("Faq");
    }

    public function index()
    {
        $data['faqs'] = $this->faq->all();
        $this->view("admin/faq/index", $data);
    }

    public function create()
    {
        $this->view("admin/faq/create");
    }

    public function store()
    {
        $this->faq->create($_POST);
        header("Location: /admin/faq");
        exit;
    }

    public function edit($id)
    {
        $data['faq'] = $this->faq->find($id);
        $this->view("admin/faq/edit", $data);
    }

    public function update($id)
    {
        $this->faq->updateFaq($id, $_POST);
        header("Location: /admin/faq");
        exit;
    }

    public function delete($id)
    {
        $this->faq->deleteFaq($id);
        header("Location: /admin/faq");
        exit;
    }
}
