<?php
class Empresa {
    private $id_empresa;
    private $nombre_empresa;
    private $direccion;
    private $telefono;
    private $email;
    private $creado_en;
    private $actualizado_en;

    // ====== Getters ======
    public function getIdEmpresa() {
        return $this->id_empresa;
    }

    public function getNombreEmpresa() {
        return $this->nombre_empresa;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCreadoEn() {
        return $this->creado_en;
    }

    public function getActualizadoEn() {
        return $this->actualizado_en;
    }

    // ====== Setters ======
    public function setIdEmpresa($id) {
        $this->id_empresa = $id;
    }

    public function setNombreEmpresa($nombre) {
        $this->nombre_empresa = $nombre;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCreadoEn($creado) {
        $this->creado_en = $creado;
    }

    public function setActualizadoEn($actualizado) {
        $this->actualizado_en = $actualizado;
    }
}
