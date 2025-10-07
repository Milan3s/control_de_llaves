<?php
class Empleado {
    private $id_empleado;
    private $nombre;
    private $apellidos;
    private $telefono1;
    private $telefono2;
    private $id_empresa;
    private $fecha_registro;

    // ====== Getters ======
    public function getIdEmpleado() {
        return $this->id_empleado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono1() {
        return $this->telefono1;
    }

    public function getTelefono2() {
        return $this->telefono2;
    }

    public function getIdEmpresa() {
        return $this->id_empresa;
    }

    public function getFechaRegistro() {
        return $this->fecha_registro;
    }

    // ====== Setters ======
    public function setIdEmpleado($id) {
        $this->id_empleado = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setTelefono1($telefono1) {
        $this->telefono1 = $telefono1;
    }

    public function setTelefono2($telefono2) {
        $this->telefono2 = $telefono2;
    }

    public function setIdEmpresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    public function setFechaRegistro($fecha) {
        $this->fecha_registro = $fecha;
    }
}
