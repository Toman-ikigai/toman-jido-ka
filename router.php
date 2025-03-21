<?php

require "./src/controller/controller.php";

define('BASE_PATH', __DIR__ . '/src/');

$requestUri = $_SERVER["REQUEST_URI"];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$segments = explode("/", trim($requestPath, "/")); // Dividir la URL en segmentos

$allowedLangs = ["es", "en"];
$language = $segments[0] ?? "es"; // Por defecto "es"

// Redirigir si el idioma no está permitido
if (!in_array($language, $allowedLangs)) {
    header("Location: /es", true, 301);
    exit();
}

$controller = new Controller();

switch ($segments[1] ?? "") {
    case "":
        $controller->home($language);
        break;
    case "about":
        $controller->about();
        break;
    case "render-pdf":
        $title = $segments[2] ?? null;
        $id = $segments[3] ?? null;

        if ($id === null || $id === '' || !$title) {
            echo "404 Not Found";
            exit();
        }

        $controller->renderPdf($title, $id, $language);
        break;
    case "order":
        $controller->order($language);
        break;
    case "product":
        $id = $segments[2] ?? null;

        if ($id === null || $id === '') {
            echo "404 Not Found";
            exit();
        }

        $controller->product($language, $id);
        break;
    case "dashboard":
        $controller->dashboard($language);
        break;
    case "products":
        $controller->viewProducts($language);
        break;
    case "create-product":
        $controller->createProducts($language);
        break;
    default:
        echo "404 Not Found";
        break;
}
