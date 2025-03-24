<?php

$server = "";
$user = "";
$pass = "";
$db = "";

try {
    $connexion = new mysqli($server, $user, $pass, $db);
    if ($connexion->connect_error) {
        throw new Exception("Error de conexión: " . $connexion->connect_error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    header("Location: /");
    exit();
}

// $rol = $connexion->real_escape_string($_POST['rol']);
