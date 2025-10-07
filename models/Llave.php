<?php
class Llave {
    private $id_llave;
    private $codigo_llave;
    private $descripcion;
    private $id_empleado;
    private $id_empresa;
    private $nombre_empleado;
    private $apellidos_empleado;
    private $nombre_empresa;
    private $hora_cogido;
    private $hora_dejado;

    // ====== Getters ======
    public function getIdLlave() {
        return $this->id_llave;
    }

    public function getCodigoLlave() {
        return $this->codigo_llave;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdEmpleado() {
        return $this->id_empleado;
    }

    public function getIdEmpresa() {
        return $this->id_empresa;
    }

    public function getNombreEmpleado() {
        return $this->nombre_empleado;
    }

    public function getApellidosEmpleado() {
        return $this->apellidos_empleado;
    }

    public function getNombreEmpresa() {
        return $this->nombre_empresa;
    }

    public function getHoraCogido() {
        return $this->hora_cogido;
    }

    public function getHoraDejado() {
        return $this->hora_dejado;
    }

    // ====== Setters ======
    public function setIdLlave($id) {
        $this->id_llave = $id;
    }

    public function setCodigoLlave($codigo) {
        $this->codigo_llave = $codigo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdEmpleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function setNombreEmpleado($nombre) {
        $this->nombre_empleado = $nombre;
    }

    public function setApellidosEmpleado($apellidos) {
        $this->apellidos_empleado = $apellidos;
    }

    public function setNombreEmpresa($nombre_empresa) {
        $this->nombre_empresa = $nombre_empresa;
    }

    public function setHoraCogido($hora) {
        $this->hora_cogido = $hora;
    }

    public function setHoraDejado($hora) {
        $this->hora_dejado = $hora;
    }
}
