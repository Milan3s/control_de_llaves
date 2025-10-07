<?php
session_start();

require_once __DIR__ . "/../../controllers/RolController.php";
require_once __DIR__ . "/../../models/Rol.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new RolController();
    $accion = $_POST["accion"] ?? null;

    try {
        // ====== CREAR ======
        if ($accion === "crear") {
            $rol = new Rol();
            $rol->setNombreRol(trim($_POST["nombre_rol"] ?? ""));
            $rol->setDescripcion(trim($_POST["descripcion"] ?? ""));

            $resultado = $controller->registrar($rol);

            if ($resultado === true) {
                $_SESSION["msg_success"] = "Rol creado correctamente.";
            } elseif ($resultado === "duplicado") {
                $_SESSION["msg_error"] = "El nombre de rol ya está en uso.";
            } else {
                $_SESSION["msg_error"] = "Error inesperado al crear rol: " . htmlspecialchars($resultado);
            }

            header("Location: ../../views/roles.php");
            exit;
        }

        // ====== EDITAR ======
        if ($accion === "editar" && !empty($_POST["id_rol"])) {
            $rol = new Rol();
            $rol->setIdRol(intval($_POST["id_rol"]));
            $rol->setNombreRol(trim($_POST["nombre_rol"] ?? ""));
            $rol->setDescripcion(trim($_POST["descripcion"] ?? ""));

            $resultado = $controller->actualizar($rol);

            if ($resultado === true) {
                $_SESSION["msg_success"] = "Rol actualizado correctamente.";
            } elseif ($resultado === "duplicado") {
                $_SESSION["msg_error"] = "El nombre de rol ya está en uso.";
            } else {
                $_SESSION["msg_error"] = "Error inesperado al actualizar rol: " . htmlspecialchars($resultado);
            }

            header("Location: ../../views/roles.php");
            exit;
        }

        // ====== ELIMINAR ======
        if ($accion === "eliminar" && !empty($_POST["id_rol"])) {
            $id_rol = intval($_POST["id_rol"]);
            $resultado = $controller->eliminar($id_rol);

            if ($resultado === true) {
                $_SESSION["msg_success"] = "Rol eliminado correctamente.";
            } else {
                $_SESSION["msg_error"] = "Error al eliminar rol: " . htmlspecialchars($resultado);
            }

            header("Location: ../../views/roles.php");
            exit;
        }

        // ====== ACCIÓN DESCONOCIDA ======
        $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
        header("Location: ../../views/roles.php");
        exit;

    } catch (Exception $e) {
        // Captura cualquier error no controlado
        $_SESSION["msg_error"] = "Error del sistema: " . htmlspecialchars($e->getMessage());
        header("Location: ../../views/roles.php");
        exit;
    }
}
