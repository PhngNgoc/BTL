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
        $aboutUs = $this->setting->get('about_us');

        $this->render('about/index', [
            'title'    => 'Giới thiệu',
            'about_us' => $aboutUs
        ]);
    }
}
