<?php
function getContentJsonLang($section, $lang)
{
    // Ruta base de los archivos JSON
    $basePath = realpath(__DIR__ . '/../lang/') . '/';
    // echo "basePath: $basePath";

    // Verificar si el archivo del idioma existe
    $langFilePath = $basePath . $lang . '.json';
    if (!file_exists($langFilePath)) {
        // Si no existe, usar el archivo predeterminado (es.json)
        $langFilePath = $basePath . 'es.json';
    }

    // Leer el contenido del archivo JSON
    $jsonContent = file_get_contents($langFilePath);
    if ($jsonContent === false) {
        throw new Exception("No se pudo leer el archivo JSON: $langFilePath");
    }

    // Decodificar el JSON a un array asociativo
    $langData = json_decode($jsonContent, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
    }

    // Verificar si la sección existe en el JSON
    if (!array_key_exists($section, $langData)) {
        throw new Exception("La sección '$section' no existe en el archivo JSON.");
    }

    // Devolver la sección solicitada
    return $langData[$section];
}
