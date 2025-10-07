<?php
class Rutas {
    // Detecta si estás en localhost o en el servidor
    public static function baseUrl() {
        // Si estás en tu entorno local
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            return '/control-de-llaves/';
        } else {
            // Si estás en producción (ajústalo según tu estructura)
            return '/app-control-de-llaves/';
        }
    }
}
