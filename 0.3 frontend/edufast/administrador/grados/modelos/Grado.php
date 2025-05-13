<?php
class Grado {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function crear($nivel_educativo, $grados) {
        $this->db->beginTransaction();

        $stmt = $this->db->prepare("INSERT INTO grado (nivel_educativo, grado) VALUES (?, ?)");

        foreach ($grados as $grado) {
            if (!$stmt->execute([$nivel_educativo, $grado])) {
                $this->db->rollBack();
                return false;
            }
        }

        return $this->db->commit();
    }

    public function actualizar($id_grado, $nivel_educativo, $grado) {
        $stmt = $this->db->prepare("UPDATE grado SET nivel_educativo = ?, grado = ? WHERE id_grado = ?");
        return $stmt->execute([$nivel_educativo, $grado, $id_grado]);
    }

    public function eliminar($id_grado) {
        $this->db->beginTransaction();

        $stmt = $this->db->prepare("DELETE FROM grado WHERE id_grado = ?");
        $resultado = $stmt->execute([$id_grado]);

        if ($resultado) {
            return $this->db->commit();
        } else {
            $this->db->rollBack();
            return false;
        }
    }

    public function obtenerTodos() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM grado ORDER BY CAST(grado AS UNSIGNED) ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Puedes lanzar una excepción o manejarlo según necesites
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
