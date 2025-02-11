<?php
define("IMG_ICO", "src/img/toman.ico");
$validLangs = ["es", "en"];
$browserLang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
$defaultLang = in_array($browserLang, $validLangs) ? $browserLang : "es";

if (!$lang || !in_array($lang, $validLangs)) {
    $currentUrl = strtok($_SERVER["REQUEST_URI"], '?');
    $redirectUrl = "/$defaultLang";
    header("Location: $redirectUrl", true, 302);
    exit;
}

$langPath = $lang;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMG_ICO ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        name="description"
        content="Toman Jido-Ka Ikigai es una empresa de ingeniería que se dedica a la construcción de proyectos de infraestructura y edificación." />
    <meta name="keywords" content="Automatizacion,Servicios,Ingenieria,Proyectos" />
    <meta name="author" content="Toman Jido-Ka Ikigai" />
    <meta name="copyright" content="© 2025 Toman Jido-Ka Ikigai. Todos los derechos reservados." />
    <meta name="google-site-verification" content="o8D_4FXb46-awY_Jw-bM7xhDa3xcxGI0AML1_4C7gE4" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Toman Jido-ka Ikigai</title>
</head>

<body class="bg-[#2c2c2c]">
    <!-- Header -->
    <?php include BASE_PATH . 'components/header.php'; ?>
    <main>
        <?php include BASE_PATH . "components/Carrusel.php"; ?>
        <?php include BASE_PATH . "components/section/Services.php"; ?>
        <?php include BASE_PATH . "components/section/Operaciones.php"; ?>
        <?php include BASE_PATH . "components/section/Areas.php"; ?>
        <?php include BASE_PATH . "components/section/Catalago.php"; ?>
        <?php include BASE_PATH . "components/section/Proyectos.php"; ?>

        <?php include BASE_PATH . "components/section/Spot.php"; ?>
        <?php include BASE_PATH . "components/section/Identity.php"; ?>
        <?php include BASE_PATH . "components/section/Mission.php"; ?>
        <?php include BASE_PATH . "components/section/Vision.php"; ?>
        <?php include BASE_PATH . "components/section/Values.php"; ?>
        <?php include BASE_PATH . "components/section/Offers.php"; ?>

        <?php include BASE_PATH . "components/section/Contacto.php"; ?>

    </main>
    <?php include BASE_PATH . "components/section/Footer.php"; ?>
</body>

</html>