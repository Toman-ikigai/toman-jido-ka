<?php
class Controller
{
    public function home($lang)
    {
        include 'src/views/home.php';
    }

    public function about()
    {
        include "src/views/about.php";
    }

    public function renderPdf($id,$lang)
    {
        include "src/views/renderPdf.php";
    }
}
