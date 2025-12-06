<?php

class AboutController extends Controller
{
    private $setting;

    public function __construct()
    {
        $this->setting = $this->model("Setting");
    }

    public function index()
    {
        $data['about_us'] = $this->setting->get('about_us');
        $this->view("about/index", $data);
    }
}
