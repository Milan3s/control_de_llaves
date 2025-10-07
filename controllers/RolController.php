<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Rol.php";

class RolController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function registrar(Rol $rol) {
        $sql = "INSERT INTO roles (nombre_rol, descripcion) 
                VALUES (:nombre_rol, :descripcion)";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_rol" => $rol->getNombreRol(),
                ":descripcion" => $rol->getDescripcion()
            ]);
        } catch (PDOException $e) {
            // Código 23000 = duplicado
            return $e->getCode() == 23000 ? "duplicado" : $e->getMessage();
        }
    }
    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $sql = "SELECT * FROM roles 
                WHERE nombre_rol LIKE :termino 
                OR descripcion LIKE :termino
                ORDER BY id_rol ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":termino" => "%" . $termino . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ (todos los roles sin paginación) ======
    public function listarTodo() {
        $sql = "SELECT * FROM roles ORDER BY id_rol ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== READ (con paginación) ======
    public function listar($limite = 10, $offset = 0) {
        $sql = "SELECT * FROM roles ORDER BY id_rol ASC 
                LIMIT :limite OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limite", (int)$limite, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total registros
        $total_sql = "SELECT COUNT(*) FROM roles";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        return [
            "data" => $roles,
            "total" => $total,
            "totalPaginas" => ceil($total / $limite)
        ];
    }

    // ====== READ (un rol por ID) ======
    public function obtenerPorId($id_rol) {
        $sql = "SELECT * FROM roles WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id_rol]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== UPDATE ======
    public function actualizar(Rol $rol) {
        $sql = "UPDATE roles 
                SET nombre_rol = :nombre_rol, descripcion = :descripcion 
                WHERE id_rol = :id_rol";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_rol" => $rol->getNombreRol(),
                ":descripcion" => $rol->getDescripcion(),
                ":id_rol" => $rol->getIdRol()
            ]);
        } catch (PDOException $e) {
            return $e->getCode() == 23000 ? "duplicado" : $e->getMessage();
        }
    }

    // ====== DELETE ======
    public function eliminar($id_rol) {
        $sql = "DELETE FROM roles WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([":id" => $id_rol]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
