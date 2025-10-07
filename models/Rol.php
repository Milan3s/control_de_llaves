<?php
class Rol {
    private $id_rol;
    private $nombre_rol;
    private $descripcion;

    // ======= Getters =======
    public function getIdRol() {
        return $this->id_rol;
    }

    public function getNombreRol() {
        return $this->nombre_rol;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    // ======= Setters =======
    public function setIdRol($id) {
        $this->id_rol = $id;
    }

    public function setNombreRol($nombre) {
        $this->nombre_rol = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}
