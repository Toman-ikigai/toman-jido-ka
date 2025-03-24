<?php

declare(strict_types=1);
session_start();
require "./src/config/connexion.php";
require "./src/controller/controller.php";
require "./src/controller/products.php";
require "./src/store/products.php";

require_once 'flight/Flight.php';

define('BASE_PATH', __DIR__ . '/src/');

$allowedLangs = ["es", "en"];

// Middleware para verificar idioma
Flight::before('start', function () use ($allowedLangs) {
    $requestUri = $_SERVER["REQUEST_URI"];
    $requestPath = parse_url($requestUri, PHP_URL_PATH);
    $segments = explode("/", trim($requestPath, "/"));
    $language = $segments[0] ?? "es";

    if (!in_array($language, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
});

$product = new Products($connexion);
$controller = new Controller($connexion, $product);
$productsController = new ControllerProduct($connexion, $product);

Flight::route('/', function () use ($controller) {
    $controller->home("es");
});

Flight::route('/@lang', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    $controller->home($lang);
});

Flight::route('/@lang/about', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    $controller->about();
});

Flight::route('/@lang/render-pdf/@title/@id', function ($lang, $title, $id) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    if (!$title || !$id) {
        Flight::notFound();
    }
    $controller->renderPdf($title, $id, $lang);
});

Flight::route('/@lang/order', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    $controller->order($lang);
});

Flight::route('/@lang/product/@id', function ($lang, $id) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    if (!$id) {
        Flight::notFound();
    }
    $controller->product($lang, $id);
});

Flight::route('/@lang/login', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    $controller->login($lang);
});

Flight::route('/@lang/dashboard', function ($lang) use ($controller, $allowedLangs, $connexion) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->dashboard($lang);
});

Flight::route('/@lang/create-user', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->createUser($lang);
});

Flight::route('/@lang/create-brand', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->createBrand($lang);
});

Flight::route('/@lang/create-category', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->createCategory($lang);
});

Flight::route('/@lang/create-product', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->createProducts($lang);
});

Flight::route('/@lang/view-users', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->viewUsers($lang);
});

Flight::route('/@lang/view-brands', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->viewBrands($lang);
});


Flight::route('/@lang/view-categories', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->viewCategories($lang);
});


Flight::route('/@lang/view-products', function ($lang) use ($controller, $allowedLangs) {
    if (!in_array($lang, $allowedLangs)) {
        Flight::redirect("/es", 301);
    }
    verificarAutenticacion($lang);
    $controller->viewProducts($lang);
});


Flight::route('/es/products', function () use ($productsController) {
    $offset = (int) Flight::request()->query['offset'] ?? 0;
    $limit = 20;

    $counter = $productsController->getCount();

    if ($offset >= $counter) {
        Flight::json([
            "products" => [],
            "isMore" => false
        ]);
        return;
    }

    $products = $productsController->getAll($offset, $limit);
    $isMore = ($offset + $limit) < $counter;

    Flight::json([
        "products" => $products,
        "isMore" => $isMore
    ]);
});


Flight::start();

function verificarAutenticacion($language = "es")
{
    if (!isset($_SESSION['user']['role'])) {
        header('Location: /' . $language . '/login');
        exit();
    }
}
