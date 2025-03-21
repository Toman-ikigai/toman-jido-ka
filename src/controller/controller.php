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

    public function renderPdf($title, $id, $lang)
    {
        $langPath = $lang;
        include "src/views/renderPdf.php";
    }

    public function order($lang)
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $detalles = $_POST['detalles'] ?? [];
        //     header('Content-Type: application/json');
        //     echo json_encode(['success' => true, 'detalles' => $detalles]);
        //     exit;
        // }
        $langPath = $lang;
        include "src/views/order.php";
    }

    public function product($lang, $id){

        $langPath = $lang;
        include "src/views/product.php";
    }

    public function dashboard($lang)
    {
        include "src/views/admin/dashboard.php";
    }

    public function createProducts($lang)
    {
        include "src/views/admin/createProducts.php";
    }

    public function viewProducts($lang)
    {
        include "src/views/admin/viewProducts.php";
    }
}
