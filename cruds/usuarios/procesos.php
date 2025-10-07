<?php
session_start();

require_once __DIR__ . "/../../controllers/UsuarioController.php";
require_once __DIR__ . "/../../models/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuarioController();
    $accion = $_POST["accion"] ?? null;

    // ====== REGISTRO PÚBLICO ======
    if ($accion === "registro_publico") {
        $usuario = new Usuario();
        $usuario->setNombreUsuario(trim($_POST["nombre_usuario"]));
        $usuario->setEmail(trim($_POST["email"]));
        $usuario->setPassword($_POST["password"]);
        $usuario->setIdRol(3); // rol por defecto

        $resultado = $controller->registrar($usuario);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Usuario registrado correctamente.";
        } elseif ($resultado === "duplicado") {
            $_SESSION["msg_error"] = "El nombre de usuario o correo ya está en uso.";
        } else {
            error_log("Error al registrar usuario: " . $resultado);
            $_SESSION["msg_error"] = "Error inesperado al registrar el usuario.";
        }

        header("Location: ../../views/registro.php");
        exit;
    }

    // ====== REGISTRO DESDE ADMIN ======
    if ($accion === "registro_admin") {
        $usuario = new Usuario();
        $usuario->setNombreUsuario(trim($_POST["nombre_usuario"]));
        $usuario->setEmail(trim($_POST["email"]));
        $usuario->setPassword($_POST["password"]);
        $usuario->setIdRol(intval($_POST["id_rol"] ?? 3));

        $resultado = $controller->registrar($usuario);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Usuario creado correctamente.";
        } elseif ($resultado === "duplicado") {
            $_SESSION["msg_error"] = "El nombre de usuario o correo ya está en uso.";
        } else {
            error_log("Error al registrar usuario desde admin: " . $resultado);
            $_SESSION["msg_error"] = "Error inesperado al crear el usuario.";
        }

        header("Location: ../../views/usuarios.php");
        exit;
    }

    // ====== REGISTRO DESDE LOGIN ======
    if ($accion === "registro_login") {
        $usuario = new Usuario();
        $usuario->setNombreUsuario(trim($_POST["nombre_usuario"]));
        $usuario->setEmail(trim($_POST["email"]));
        $usuario->setPassword($_POST["password"]);
        $usuario->setIdRol(3); // siempre rol básico

        $resultado = $controller->registrar($usuario);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Usuario registrado correctamente. Ahora puede iniciar sesión.";
        } elseif ($resultado === "duplicado") {
            $_SESSION["msg_error"] = "El nombre de usuario o correo ya está en uso.";
        } else {
            error_log("Error al registrar usuario desde login: " . $resultado);
            $_SESSION["msg_error"] = "Error inesperado al registrar el usuario.";
        }

        header("Location: ../../views/registro.php");
        exit;
    }


    // ====== BORRADO ======
    if ($accion === "borrar" && !empty($_POST["id_usuario"])) {
        $id_usuario = intval($_POST["id_usuario"]);
        $resultado = $controller->eliminar($id_usuario);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Usuario eliminado correctamente.";
        } else {
            error_log("Error al eliminar usuario: " . $resultado);
            $_SESSION["msg_error"] = "Error inesperado al eliminar el usuario.";
        }

        header("Location: ../../views/usuarios.php");
        exit;
    }

    // ====== ACTUALIZAR ======
    if ($accion === "actualizar" && !empty($_POST["id_usuario"])) {
        $usuario = new Usuario();
        $usuario->setIdUsuario(intval($_POST["id_usuario"]));
        $usuario->setNombreUsuario(trim($_POST["nombre_usuario"]));
        $usuario->setEmail(trim($_POST["email"]));
        $usuario->setIdRol(intval($_POST["id_rol"]));
        $usuario->setActivo(isset($_POST["activo"]) ? 1 : 0);

        $resultado = $controller->actualizar($usuario);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Usuario actualizado correctamente.";
        } elseif ($resultado === "duplicado") {
            $_SESSION["msg_error"] = "El nombre de usuario o correo ya está en uso.";
        } else {
            error_log("Error al actualizar usuario: " . $resultado);
            $_SESSION["msg_error"] = "Error inesperado al actualizar el usuario.";
        }

        header("Location: ../../views/usuarios.php");
        exit;
    }

    // ====== ACCIÓN DESCONOCIDA ======
    $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
    header("Location: ../../views/usuarios.php");
    exit;
}
