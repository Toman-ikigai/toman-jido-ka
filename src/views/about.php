<?php
// URL del archivo PDF
$pdfUrl = 'https://res.cloudinary.com/dvggwdqnj/image/upload/v1734647242/catalagos/hizppmcqr7owwj3htkje.pdf'; // Reemplaza con la URL de tu archivo PDF

// Establecer encabezados para mostrar el PDF en el navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"');

// Limpiar el buffer de salida
ob_clean();
flush();

// Leer el contenido del PDF desde la URL y enviarlo al navegador
readfile($pdfUrl);
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        About Us
    </title>
</head>

<body>
    <h1 class=" text-3xl">
        About Us
    </h1>
</body>

</html>