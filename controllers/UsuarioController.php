<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function registrar(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (nombre_usuario, email, password, id_rol) 
                VALUES (:nombre_usuario, :email, :password, :id_rol)";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_usuario" => $usuario->getNombreUsuario(),
                ":email" => $usuario->getEmail(),
                ":password" => password_hash($usuario->getPassword(), PASSWORD_BCRYPT),
                ":id_rol" => $usuario->getIdRol() ?? 3
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "duplicado"; // usuario o email ya en uso
            }
            return $e->getMessage();
        }
    }

    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $termino = trim($termino);

        $sql = "SELECT u.id_usuario, 
                    u.nombre_usuario, 
                    u.email, 
                    r.nombre_rol AS rol, 
                    u.activo 
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol";

        if (!empty($termino)) {
            $sql .= " WHERE u.nombre_usuario LIKE :termino
                    OR u.email LIKE :termino
                    OR r.nombre_rol LIKE :termino";
        }

        $sql .= " ORDER BY u.id_usuario ASC";

        $stmt = $this->pdo->prepare($sql);

        if (!empty($termino)) {
            $stmt->execute([":termino" => "%" . $termino . "%"]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ (login) ======
    public function login($nombre_usuario, $password) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario AND activo = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":nombre_usuario" => $nombre_usuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row["password"])) {
            $usuario = new Usuario();
            $usuario->setIdUsuario($row["id_usuario"]);
            $usuario->setNombreUsuario($row["nombre_usuario"]);
            $usuario->setEmail($row["email"]);
            $usuario->setIdRol($row["id_rol"]);
            $usuario->setActivo($row["activo"]);
            return $usuario;
        }
        return false;
    }

    // ====== READ (listar normal sin paginación) ======
    public function listarTodo() {
        $sql = "SELECT u.id_usuario, 
                       u.nombre_usuario, 
                       u.email, 
                       r.nombre_rol AS rol, 
                       u.activo 
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                ORDER BY u.id_usuario ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== READ (listar con paginación) ======
    public function listarPaginado($pagina = 1, $porPagina = 10) {
        $offset = ($pagina - 1) * $porPagina;

        $sql = "SELECT u.id_usuario, 
                       u.nombre_usuario, 
                       u.email, 
                       r.nombre_rol AS rol, 
                       u.activo 
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                ORDER BY u.id_usuario ASC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", (int)$porPagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total de registros
        $total_sql = "SELECT COUNT(*) FROM usuarios";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        return [
            "usuarios" => $usuarios,
            "total" => $total,
            "pagina" => $pagina,
            "por_pagina" => $porPagina,
            "total_paginas" => ceil($total / $porPagina)
        ];
    }

    // ====== UPDATE ======
    public function actualizar(Usuario $usuario) {
        $sql = "UPDATE usuarios 
                SET nombre_usuario = :nombre_usuario, 
                    email = :email, 
                    id_rol = :id_rol, 
                    activo = :activo 
                WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_usuario" => $usuario->getNombreUsuario(),
                ":email" => $usuario->getEmail(),
                ":id_rol" => $usuario->getIdRol(),
                ":activo" => $usuario->getActivo(),
                ":id_usuario" => $usuario->getIdUsuario()
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "duplicado";
            }
            return $e->getMessage();
        }
    }

    // ====== DELETE ======
    public function eliminar($id_usuario) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([":id" => $id_usuario]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
