<?php
class Incidencia {
    private $id_incidencia;
    private $id_llave;
    private $id_empleado;
    private $id_usuario;
    private $tipo_incidencia; // perdida, daniada, retraso, otra
    private $descripcion;
    private $fecha_incidencia;
    private $resuelta;

    // ======= Getters =======
    public function getIdIncidencia() {
        return $this->id_incidencia;
    }

    public function getIdLlave() {
        return $this->id_llave;
    }

    public function getIdEmpleado() {
        return $this->id_empleado;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getTipoIncidencia() {
        return $this->tipo_incidencia;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFechaIncidencia() {
        return $this->fecha_incidencia;
    }

    public function getResuelta() {
        return $this->resuelta;
    }

    // ======= Setters =======
    public function setIdIncidencia($id) {
        $this->id_incidencia = $id;
    }

    public function setIdLlave($id_llave) {
        $this->id_llave = $id_llave;
    }

    public function setIdEmpleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setTipoIncidencia($tipo) {
        $this->tipo_incidencia = $tipo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFechaIncidencia($fecha) {
        $this->fecha_incidencia = $fecha;
    }

    public function setResuelta($resuelta) {
        $this->resuelta = $resuelta;
    }
}
