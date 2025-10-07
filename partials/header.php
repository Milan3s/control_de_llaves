<?php
require_once __DIR__ . '/../config/Rutas.php';
$baseUrl = Rutas::baseUrl();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Llaves</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/bootstrap-5.3.8/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/fontawesome-free-7.0.1/css/all.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/styles.css">
</head>
<body>
