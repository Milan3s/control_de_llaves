<?php
session_start();

require_once __DIR__ . "/../../controllers/UsuarioController.php";
require_once __DIR__ . "/../../models/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] === "login") {
    $controller = new UsuarioController();

    $nombre_usuario = trim($_POST["nombre_usuario"]);
    $password = $_POST["password"];

    $usuario = $controller->login($nombre_usuario, $password);

    if ($usuario) {
        // Guardamos datos en la sesión
        $_SESSION["id_usuario"] = $usuario->getIdUsuario();
        $_SESSION["nombre_usuario"] = $usuario->getNombreUsuario();
        $_SESSION["id_rol"] = $usuario->getIdRol();

        // Redirigir al dashboard
        header("Location: ../../views/dashboard.php");
        exit;
    } else {
        // Redirigir de nuevo al login con error
        header("Location: ../../views/login.php?error=login");
        exit;
    }
} else {
    // Si acceden directo sin POST
    header("Location: ../../views/login.php");
    exit;
}
