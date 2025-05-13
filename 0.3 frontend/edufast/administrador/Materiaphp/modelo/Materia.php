<?php
include_once "../configuracion/conexion.php";

class Materia {
    private $db;

    public function __construct() {
        global $base_de_datos;
        $this->db = $base_de_datos;
    }

    public function crear($materia, $area_id_area) {
        $stmt = $this->db->prepare("INSERT INTO materia (materia, area_id_area) VALUES (?, ?);");
        return $stmt->execute([$materia, $area_id_area]);
    }

    public function actualizar($id_materia, $materia, $area_id_area) {
        $stmt = $this->db->prepare("UPDATE materia SET materia = ?, area_id_area = ? WHERE id_materia = ?");
        return $stmt->execute([$materia, $area_id_area, $id_materia]);
    }

    public function eliminar($id_materia) {
        $stmt = $this->db->prepare("DELETE FROM materia WHERE id_materia = ?");
        return $stmt->execute([$id_materia]);
    }

    public function obtenerTodas() {
        $sql = "
            SELECT materia.*, area.nombre_area, area.id_area
            FROM materia
            INNER JOIN area ON materia.area_id_area = area.id_area
            ORDER BY area.nombre_area ASC
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
