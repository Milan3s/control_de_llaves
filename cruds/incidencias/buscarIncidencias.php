<?php
require_once __DIR__ . "/../../controllers/IncidenciaController.php";

header("Content-Type: application/json");

$controller = new IncidenciaController();

$termino = isset($_GET['q']) ? $_GET['q'] : "";

$resultados = $controller->buscar($termino);

echo json_encode($resultados);
