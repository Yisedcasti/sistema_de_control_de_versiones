<?php
require_once '../configuracion/Conexion.php';

class Curso {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function crear($curso, $grado_id_grado) {
        $sql = "INSERT INTO cursos (curso, grado_id_grado) VALUES (:curso, :grado_id_grado)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':curso' => $curso,
            ':grado_id_grado' => $grado_id_grado
        ]);
    }

    public function actualizar($id_cursos, $curso, $grado_id_grado) {
        $sql = "UPDATE cursos SET curso = ?, grado_id_grado = ? WHERE id_cursos = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$curso, $grado_id_grado, $id_cursos]);
    }

    public function eliminar($id_cursos) {
        $sql = "DELETE FROM cursos WHERE id_cursos = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_cursos]);
    }
}
