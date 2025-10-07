<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Empleado.php";

class EmpleadoController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function crear(Empleado $empleado) {
        $sql = "INSERT INTO empleados (nombre, apellidos, telefono1, telefono2, id_empresa) 
                VALUES (:nombre, :apellidos, :telefono1, :telefono2, :id_empresa)";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre"     => $empleado->getNombre(),
                ":apellidos"  => $empleado->getApellidos(),
                ":telefono1"  => $empleado->getTelefono1(),
                ":telefono2"  => $empleado->getTelefono2(),
                ":id_empresa" => $empleado->getIdEmpresa()
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $sql = "SELECT e.id_empleado, e.nombre, e.apellidos, e.telefono1, e.telefono2, 
                    em.nombre_empresa, e.fecha_registro
                FROM empleados e
                INNER JOIN empresas em ON e.id_empresa = em.id_empresa
                WHERE e.nombre LIKE :termino
                OR e.apellidos LIKE :termino
                OR e.telefono1 LIKE :termino
                OR e.telefono2 LIKE :termino
                OR em.nombre_empresa LIKE :termino
                ORDER BY e.id_empleado ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":termino" => "%" . $termino . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ (todos los empleados con su empresa) ======
    public function listarTodo() {
        $sql = "SELECT e.id_empleado, e.nombre, e.apellidos, e.telefono1, e.telefono2, 
                       em.nombre_empresa, e.fecha_registro
                FROM empleados e
                INNER JOIN empresas em ON e.id_empresa = em.id_empresa
                ORDER BY e.id_empleado ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== READ (empleados con paginación) ======
    public function listarPaginado($pagina = 1, $por_pagina = 10) {
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT e.id_empleado, e.nombre, e.apellidos, e.telefono1, e.telefono2, 
                       em.nombre_empresa, e.fecha_registro
                FROM empleados e
                INNER JOIN empresas em ON e.id_empresa = em.id_empresa
                ORDER BY e.id_empleado ASC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", (int)$por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total de registros
        $total_sql = "SELECT COUNT(*) FROM empleados";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        return [
            "empleados"     => $empleados,
            "total"         => $total,
            "pagina"        => $pagina,
            "por_pagina"    => $por_pagina,
            "total_paginas" => ceil($total / $por_pagina)
        ];
    }

    // ====== READ (empleado por ID) ======
    public function obtenerPorId($id_empleado) {
        $sql = "SELECT * FROM empleados WHERE id_empleado = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id_empleado]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== UPDATE ======
    public function actualizar(Empleado $empleado) {
        $sql = "UPDATE empleados 
                SET nombre = :nombre, 
                    apellidos = :apellidos, 
                    telefono1 = :telefono1, 
                    telefono2 = :telefono2, 
                    id_empresa = :id_empresa
                WHERE id_empleado = :id_empleado";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre"      => $empleado->getNombre(),
                ":apellidos"   => $empleado->getApellidos(),
                ":telefono1"   => $empleado->getTelefono1(),
                ":telefono2"   => $empleado->getTelefono2(),
                ":id_empresa"  => $empleado->getIdEmpresa(),
                ":id_empleado" => $empleado->getIdEmpleado()
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ====== DELETE ======
    public function eliminar($id_empleado) {
        $sql = "DELETE FROM empleados WHERE id_empleado = :id";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([":id" => $id_empleado]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
