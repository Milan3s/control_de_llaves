<?php
require_once __DIR__ . "/../config/Conexion.php";
require_once __DIR__ . "/../models/Empresa.php";

class EmpresaController {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->conectar();
    }

    // ====== CREATE ======
    public function crear(Empresa $empresa) {
        $sql = "INSERT INTO empresas (nombre_empresa, direccion, telefono, email) 
                VALUES (:nombre_empresa, :direccion, :telefono, :email)";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_empresa" => $empresa->getNombreEmpresa(),
                ":direccion"      => $empresa->getDireccion(),
                ":telefono"       => $empresa->getTelefono(),
                ":email"          => $empresa->getEmail()
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ====== READ (todas las empresas) ======
    public function listar() {
        $sql = "SELECT * FROM empresas ORDER BY id_empresa ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== READ (buscar por término) ======
    public function buscar($termino) {
        $sql = "SELECT * FROM empresas 
                WHERE nombre_empresa LIKE :termino
                OR direccion LIKE :termino
                OR telefono LIKE :termino
                OR email LIKE :termino
                ORDER BY id_empresa ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":termino" => "%" . $termino . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ====== READ (empresas con paginación) ======
    public function listarPaginado($pagina = 1, $por_pagina = 10) {
        $offset = ($pagina - 1) * $por_pagina;

        $sql = "SELECT * FROM empresas 
                ORDER BY id_empresa ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":limit", (int)$por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener total de registros
        $total_sql = "SELECT COUNT(*) FROM empresas";
        $total = $this->pdo->query($total_sql)->fetchColumn();

        $total_paginas = ceil($total / $por_pagina);

        return [
            "empresas"      => $empresas,
            "total"         => $total,
            "pagina"        => $pagina,
            "por_pagina"    => $por_pagina,
            "total_paginas" => $total_paginas,
            "primera"       => 1,
            "ultima"        => $total_paginas
        ];
    }

    // ====== READ (una empresa por ID) ======
    public function obtenerPorId($id_empresa) {
        $sql = "SELECT * FROM empresas WHERE id_empresa = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id_empresa]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ====== UPDATE ======
    public function actualizar(Empresa $empresa) {
        $sql = "UPDATE empresas 
                SET nombre_empresa = :nombre_empresa, 
                    direccion      = :direccion, 
                    telefono       = :telefono, 
                    email          = :email 
                WHERE id_empresa  = :id_empresa";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([
                ":nombre_empresa" => $empresa->getNombreEmpresa(),
                ":direccion"      => $empresa->getDireccion(),
                ":telefono"       => $empresa->getTelefono(),
                ":email"          => $empresa->getEmail(),
                ":id_empresa"     => $empresa->getIdEmpresa()
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // ====== DELETE ======
    public function eliminar($id_empresa) {
        $sql = "DELETE FROM empresas WHERE id_empresa = :id";
        $stmt = $this->pdo->prepare($sql);

        try {
            return $stmt->execute([":id" => $id_empresa]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
