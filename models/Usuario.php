<?php
class Usuario {
    private $id_usuario;
    private $nombre_usuario;
    private $email;
    private $password;
    private $id_rol;
    private $activo;

    // ======= Getters =======
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIdRol() {
        return $this->id_rol;
    }

    public function getActivo() {
        return $this->activo;
    }

    // ======= Setters =======
    public function setIdUsuario($id) {
        $this->id_usuario = $id;
    }

    public function setNombreUsuario($nombre) {
        $this->nombre_usuario = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setIdRol($rol) {
        $this->id_rol = $rol;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
}
