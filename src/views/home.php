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
    <title>Toman Jido-ka Ikigai</title>    
    <link rel="stylesheet" href="/dist/styles.css" />
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
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
        <?php include BASE_PATH . "components/section/About.php"; ?>
        <?php include BASE_PATH . "components/section/Programas.php"; ?>
        <?php include BASE_PATH . "components/section/Contacto.php"; ?>

    </main>
    <?php include BASE_PATH . "components/section/Footer.php"; ?>
</body>

</html>