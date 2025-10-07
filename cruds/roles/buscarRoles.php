<?php
require_once __DIR__ . "/../../controllers/RolController.php";

header("Content-Type: application/json; charset=UTF-8");

$controller = new RolController();

$q = isset($_GET['q']) ? trim($_GET['q']) : "";

if ($q === "") {
    $data = $controller->listarTodo();
} else {
    $data = $controller->buscar($q);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
exit;
