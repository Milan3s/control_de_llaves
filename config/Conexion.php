<?php
class Conexion {
    private $host = "127.0.0.1";
    private $db   = "control_de_llaves";
    private $user = "root";   // cámbialo según tu configuración
    private $pass = "";       // cámbialo según tu configuración
    private $charset = "utf8mb4";
    private $pdo;
    private $error;

    public function conectar() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "Error en la conexión: " . $this->error;
            return null;
        }
    }
}
