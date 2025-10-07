<?php
session_start();

require_once __DIR__ . "/../../controllers/EmpresaController.php";
require_once __DIR__ . "/../../models/Empresa.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EmpresaController();
    $accion = $_POST["accion"] ?? null;

    // ====== CREAR ======
    if ($accion === "crear") {
        $empresa = new Empresa();
        $empresa->setNombreEmpresa(trim($_POST["nombre_empresa"]));
        $empresa->setDireccion(trim($_POST["direccion"]));
        $empresa->setTelefono(trim($_POST["telefono"]));
        $empresa->setEmail(trim($_POST["email"]));

        $resultado = $controller->crear($empresa);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empresa creada correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al crear empresa: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empresas.php");
        exit;
    }

    // ====== ACTUALIZAR ======
    if ($accion === "actualizar" && !empty($_POST["id_empresa"])) {
        $empresa = new Empresa();
        $empresa->setIdEmpresa(intval($_POST["id_empresa"]));
        $empresa->setNombreEmpresa(trim($_POST["nombre_empresa"]));
        $empresa->setDireccion(trim($_POST["direccion"]));
        $empresa->setTelefono(trim($_POST["telefono"]));
        $empresa->setEmail(trim($_POST["email"]));

        $resultado = $controller->actualizar($empresa);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empresa actualizada correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al actualizar empresa: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empresas.php");
        exit;
    }

    // ====== ELIMINAR ======
    if ($accion === "eliminar" && !empty($_POST["id_empresa"])) {
        $resultado = $controller->eliminar(intval($_POST["id_empresa"]));

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empresa eliminada correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al eliminar empresa: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empresas.php");
        exit;
    }

    // ====== ACCIÓN INVÁLIDA ======
    $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
    header("Location: ../../views/empresas.php");
    exit;
}
