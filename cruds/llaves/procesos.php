<?php
session_start();

require_once __DIR__ . "/../../controllers/LlaveController.php";
require_once __DIR__ . "/../../models/Llave.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new LlaveController();
    $accion = $_POST["accion"] ?? null;

    // ====== CREAR ======
    if ($accion === "crear") {
        $llave = new Llave();
        $llave->setCodigoLlave(trim($_POST["codigo_llave"]));
        $llave->setDescripcion(trim($_POST["descripcion"]));
        $llave->setIdEmpleado(intval($_POST["id_empleado"]));
        $llave->setIdEmpresa(intval($_POST["id_empresa"]));
        $llave->setHoraCogido($_POST["hora_cogido"] ?: null);
        $llave->setHoraDejado($_POST["hora_dejado"] ?: null);

        $resultado = $controller->crear($llave);

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Llave registrada correctamente." : "Error al registrar llave.";
        
        header("Location: ../../views/llaves.php");
        exit;
    }

    // ====== ACTUALIZAR ======
    if ($accion === "actualizar" && !empty($_POST["id_llave"])) {
        $llave = new Llave();
        $llave->setIdLlave(intval($_POST["id_llave"]));
        $llave->setCodigoLlave(trim($_POST["codigo_llave"]));
        $llave->setDescripcion(trim($_POST["descripcion"]));
        $llave->setIdEmpleado(intval($_POST["id_empleado"]));
        $llave->setIdEmpresa(intval($_POST["id_empresa"]));
        $llave->setHoraCogido($_POST["hora_cogido"] ?: null);
        $llave->setHoraDejado($_POST["hora_dejado"] ?: null);

        $resultado = $controller->actualizar($llave);

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Llave actualizada correctamente." : "Error al actualizar llave.";
        
        header("Location: ../../views/llaves.php");
        exit;
    }

    // ====== ELIMINAR ======
    if ($accion === "eliminar" && !empty($_POST["id_llave"])) {
        $resultado = $controller->eliminar(intval($_POST["id_llave"]));

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Llave eliminada correctamente." : "Error al eliminar llave.";
        
        header("Location: ../../views/llaves.php");
        exit;
    }

    // ====== ACCIÓN INVÁLIDA ======
    $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
    header("Location: ../../views/llaves.php");
    exit;
}
