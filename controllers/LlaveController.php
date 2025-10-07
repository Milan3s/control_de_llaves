<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Llave.php";

class LlaveController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function crear(Llave $llave) {
        $sql = "INSERT INTO llaves 
                (codigo_llave, descripcion, id_empleado, id_empresa, hora_cogido, hora_dejado) 
                VALUES (:codigo_llave, :descripcion, :id_empleado, :id_empresa, :hora_cogido, :hora_dejado)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":codigo_llave" => $llave->getCodigoLlave(),
            ":descripcion"  => $llave->getDescripcion(),
            ":id_empleado"  => $llave->getIdEmpleado(),
            ":id_empresa"   => $llave->getIdEmpresa(),
            ":hora_cogido"  => $llave->getHoraCogido(),
            ":hora_dejado"  => $llave->getHoraDejado()
        ]);
    }

    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $termino = trim($termino);

        $sql = "SELECT l.id_llave, 
                    l.codigo_llave, 
                    l.descripcion,
                    e.nombre AS nombre_empleado, 
                    e.apellidos AS apellidos_empleado,
                    em.nombre_empresa,
                    l.hora_cogido, 
                    l.hora_dejado
                FROM llaves l
                LEFT JOIN empleados e ON l.id_empleado = e.id_empleado
                LEFT JOIN empresas em ON l.id_empresa = em.id_empresa";

        if (!empty($termino)) {
            $sql .= " WHERE l.codigo_llave LIKE :termino
                    OR l.descripcion LIKE :termino
                    OR e.nombre LIKE :termino
                    OR e.apellidos LIKE :termino
                    OR em.nombre_empresa LIKE :termino";
        }

        $sql .= " ORDER BY l.id_llave ASC";

        $stmt = $this->pdo->prepare($sql);

        if (!empty($termino)) {
            $stmt->execute([":termino" => "%" . $termino . "%"]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ (listar con paginación) ======
    public function listarPaginado($pagina = 1, $por_pagina = 10) {
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT l.id_llave, l.codigo_llave, l.descripcion,
                       l.id_empleado, e.nombre AS nombre_empleado, e.apellidos AS apellidos_empleado,
                       l.id_empresa, em.nombre_empresa,
                       l.hora_cogido, l.hora_dejado
                FROM llaves l
                LEFT JOIN empleados e ON l.id_empleado = e.id_empleado
                LEFT JOIN empresas em ON l.id_empresa = em.id_empresa
                ORDER BY l.id_llave ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", (int)$por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $llaves = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total registros
        $total_sql = "SELECT COUNT(*) FROM llaves";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        return [
            "llaves"        => $llaves,
            "total"         => $total,
            "pagina"        => $pagina,
            "por_pagina"    => $por_pagina,
            "total_paginas" => ceil($total / $por_pagina)
        ];
    }

    // ====== READ (una llave por ID) ======
    public function obtenerPorId($id_llave) {
        $sql = "SELECT l.*, 
                       e.nombre AS nombre_empleado, e.apellidos AS apellidos_empleado, 
                       em.nombre_empresa
                FROM llaves l
                LEFT JOIN empleados e ON l.id_empleado = e.id_empleado
                LEFT JOIN empresas em ON l.id_empresa = em.id_empresa
                WHERE l.id_llave = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id_llave]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== UPDATE ======
    public function actualizar(Llave $llave) {
        $sql = "UPDATE llaves 
                SET codigo_llave = :codigo_llave, 
                    descripcion  = :descripcion,
                    id_empleado  = :id_empleado,
                    id_empresa   = :id_empresa,
                    hora_cogido  = :hora_cogido,
                    hora_dejado  = :hora_dejado
                WHERE id_llave  = :id_llave";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":codigo_llave" => $llave->getCodigoLlave(),
            ":descripcion"  => $llave->getDescripcion(),
            ":id_empleado"  => $llave->getIdEmpleado(),
            ":id_empresa"   => $llave->getIdEmpresa(),
            ":hora_cogido"  => $llave->getHoraCogido(),
            ":hora_dejado"  => $llave->getHoraDejado(),
            ":id_llave"     => $llave->getIdLlave()
        ]);
    }

    // ====== DELETE ======
    public function eliminar($id_llave) {
        $sql = "DELETE FROM llaves WHERE id_llave = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id" => $id_llave]);
    }

    // ====== READ (empleados para selects) ======
    public function listarEmpleados() {
        $sql = "SELECT id_empleado, nombre, apellidos 
                FROM empleados 
                ORDER BY nombre ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== READ (empresas para selects) ======
    public function listarEmpresas() {
        $sql = "SELECT id_empresa, nombre_empresa 
                FROM empresas 
                ORDER BY nombre_empresa ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
