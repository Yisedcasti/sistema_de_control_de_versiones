<?php
include_once "../configuracion/conexion.php";
class Jornada {
    private $base_de_datos;

    public function __construct($base_de_datos) {
        $this->base_de_datos = $base_de_datos;
    }

    // Crear una nueva jornada
    public function crear($jornada, $hora_inicio, $hora_final) {
        $sentencia = $this->base_de_datos->prepare("
            INSERT INTO jornada (jornada, hora_inicio, hora_final) 
            VALUES (?, ?, ?)
        ");
        return $sentencia->execute([$jornada, $hora_inicio, $hora_final]);
    }

    // Actualizar una jornada existente
    public function actualizar($id_jornada, $jornada, $hora_inicio, $hora_final) {
        $sentencia = $this->base_de_datos->prepare("
            UPDATE jornada 
            SET jornada = ?, hora_inicio = ?, hora_final = ? 
            WHERE id_jornada = ?
        ");
        return $sentencia->execute([$jornada, $hora_inicio, $hora_final, $id_jornada]);
    }

    // Eliminar una jornada
    public function eliminar($id_jornada) {
        $sentencia = $this->base_de_datos->prepare("DELETE FROM jornada WHERE id_jornada = ?");
        return $sentencia->execute([$id_jornada]);
    }

    // Obtener todas las jornadas excepto la que tiene id_jornada = 1
    public function obtenerJornadas() {
        try {
            $sentencia = $this->base_de_datos->prepare("SELECT * FROM jornada WHERE id_jornada <> 1");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ); // Retorna las jornadas
        } catch (PDOException $e) {
            echo "Error al obtener las jornadas: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }
}
?>
