<?php
class Controller
{
    private $connexion;
    private $product;

    public function __construct($connexion, $product)
    {
        $this->connexion = $connexion;
        $this->product = $product;
    }

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
        $langPath = $lang;
        include "src/views/order.php";
    }

    public function product($lang, $id)
    {
        $langPath = $lang;
        $connexion = $this->connexion;
        $product = $this->product;
        include "src/views/product.php";
    }

    public function dashboard($lang)
    {
        $connexion = $this->connexion;
        $product = $this->product;
        include "src/views/admin/dashboard.php";
    }

    public function login($lang)
    {
        $connexion = $this->connexion;
        include "src/views/auth/login.php";
    }

    public function createUser($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/createUser.php";
    }

    public function createCategory($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/createCategory.php";
    }

    public function createBrand($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/createBrand.php";
    }

    public function createProducts($lang)
    {
        $connexion = $this->connexion;
        $product = $this->product;
        include "src/views/admin/createProducts.php";
    }

    public function viewUsers($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/viewUsers.php";
    }

    public function viewBrands($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/viewBrands.php";
    }

    public function viewCategories($lang)
    {
        $connexion = $this->connexion;
        include "src/views/admin/viewCategories.php";
    }

    public function viewProducts($lang)
    {
        $connexion = $this->connexion;
        $product = $this->product;
        include "src/views/admin/viewProducts.php";
    }
}
