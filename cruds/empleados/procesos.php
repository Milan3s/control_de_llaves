<?php
session_start();

require_once __DIR__ . "/../../controllers/EmpleadoController.php";
require_once __DIR__ . "/../../models/Empleado.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new EmpleadoController();
    $accion = $_POST["accion"] ?? null;

    // ====== CREAR ======
    if ($accion === "crear") {
        $empleado = new Empleado();
        $empleado->setNombre(trim($_POST["nombre"]));
        $empleado->setApellidos(trim($_POST["apellidos"]));
        $empleado->setTelefono1(trim($_POST["telefono1"]));
        $empleado->setTelefono2(!empty($_POST["telefono2"]) ? trim($_POST["telefono2"]) : null);
        $empleado->setIdEmpresa(intval($_POST["id_empresa"]));

        $resultado = $controller->crear($empleado);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empleado creado correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al crear empleado: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empleados.php");
        exit;
    }

    // ====== ACTUALIZAR ======
    if ($accion === "actualizar" && !empty($_POST["id_empleado"])) {
        $empleado = new Empleado();
        $empleado->setIdEmpleado(intval($_POST["id_empleado"]));
        $empleado->setNombre(trim($_POST["nombre"]));
        $empleado->setApellidos(trim($_POST["apellidos"]));
        $empleado->setTelefono1(trim($_POST["telefono1"]));
        $empleado->setTelefono2(!empty($_POST["telefono2"]) ? trim($_POST["telefono2"]) : null);
        $empleado->setIdEmpresa(intval($_POST["id_empresa"]));

        $resultado = $controller->actualizar($empleado);

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empleado actualizado correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al actualizar empleado: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empleados.php");
        exit;
    }

    // ====== ELIMINAR ======
    if ($accion === "eliminar" && !empty($_POST["id_empleado"])) {
        $resultado = $controller->eliminar(intval($_POST["id_empleado"]));

        if ($resultado === true) {
            $_SESSION["msg_success"] = "Empleado eliminado correctamente.";
        } else {
            $_SESSION["msg_error"] = "Error al eliminar empleado: " . htmlspecialchars($resultado);
        }

        header("Location: ../../views/empleados.php");
        exit;
    }

    // ====== ACCIÓN INVÁLIDA ======
    $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
    header("Location: ../../views/empleados.php");
    exit;
}
