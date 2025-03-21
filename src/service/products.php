<?php
function getProductJsonLang($lang)
{
    $basePath = realpath(__DIR__ . '/../lang/products/') . '/';

    $langFilePath = $basePath . $lang . '.json';
    if (!file_exists($langFilePath)) {
        $langFilePath = $basePath . 'es.json';
    }

    $jsonContent = file_get_contents($langFilePath);
    if ($jsonContent === false) {
        throw new Exception("No se pudo leer el archivo JSON: $langFilePath");
    }

    $langData = json_decode($jsonContent, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
    }

    return $langData ?? [];
}
