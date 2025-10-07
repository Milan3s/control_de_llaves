<?php
session_start();

require_once __DIR__ . "/../../controllers/IncidenciaController.php";
require_once __DIR__ . "/../../models/Incidencia.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new IncidenciaController();
    $accion = $_POST["accion"] ?? null;

    // ====== CREAR ======
    if ($accion === "crear") {
        $incidencia = new Incidencia();
        $incidencia->setIdLlave(intval($_POST["id_llave"]));
        $incidencia->setIdEmpleado(intval($_POST["id_empleado"]));
        $incidencia->setTipoIncidencia(trim($_POST["tipo_incidencia"]));
        $incidencia->setDescripcion(trim($_POST["descripcion"]));
        $incidencia->setFechaIncidencia(date("Y-m-d H:i:s")); // Fecha actual
        $incidencia->setResuelta(0); // Siempre pendiente al crear

        $resultado = $controller->crear($incidencia);

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Incidencia registrada correctamente." : "Error al registrar incidencia.";
        
        header("Location: ../../views/incidencias.php");
        exit;
    }

    // ====== ACTUALIZAR ======
    if ($accion === "actualizar" && !empty($_POST["id_incidencia"])) {
        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia(intval($_POST["id_incidencia"]));
        $incidencia->setIdLlave(intval($_POST["id_llave"]));
        $incidencia->setIdEmpleado(intval($_POST["id_empleado"]));
        $incidencia->setTipoIncidencia(trim($_POST["tipo_incidencia"]));
        $incidencia->setDescripcion(trim($_POST["descripcion"]));
        $incidencia->setFechaIncidencia(date("Y-m-d H:i:s")); // Se actualiza fecha si se edita
        $incidencia->setResuelta(isset($_POST["resuelta"]) ? intval($_POST["resuelta"]) : 0);

        $resultado = $controller->actualizar($incidencia);

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Incidencia actualizada correctamente." : "Error al actualizar incidencia.";
        
        header("Location: ../../views/incidencias.php");
        exit;
    }

    // ====== ELIMINAR ======
    if ($accion === "eliminar" && !empty($_POST["id_incidencia"])) {
        $resultado = $controller->eliminar(intval($_POST["id_incidencia"]));

        $_SESSION[$resultado ? "msg_success" : "msg_error"] =
            $resultado ? "Incidencia eliminada correctamente." : "Error al eliminar incidencia.";
        
        header("Location: ../../views/incidencias.php");
        exit;
    }

    // ====== ACCIÓN INVÁLIDA ======
    $_SESSION["msg_error"] = "Acción no válida o parámetros incompletos.";
    header("Location: ../../views/incidencias.php");
    exit;
}
