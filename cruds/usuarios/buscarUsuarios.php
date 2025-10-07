<?php
require_once __DIR__ . "/../../controllers/UsuarioController.php";

header("Content-Type: application/json; charset=UTF-8");

$controller = new UsuarioController();

$q = isset($_GET['q']) ? trim($_GET['q']) : "";

if ($q === "") {
    // si no hay búsqueda, devolvemos todo
    $data = $controller->listarTodo();
} else {
    $data = $controller->buscar($q);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
exit;
