<?php
require_once __DIR__ . "/../../controllers/EmpleadoController.php";

$controller = new EmpleadoController();
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$resultados = $controller->buscar($q);

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($resultados);
