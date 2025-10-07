<?php
session_start();

require_once __DIR__ . "/../../controllers/LlaveController.php";

header("Content-Type: application/json; charset=UTF-8");

try {
    $controller = new LlaveController();

    // Capturamos el término de búsqueda (si viene vacío, devuelve todas las llaves)
    $termino = isset($_GET["q"]) ? trim($_GET["q"]) : "";

    $resultados = $controller->buscar($termino);

    echo json_encode($resultados, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        "error" => true,
        "mensaje" => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
