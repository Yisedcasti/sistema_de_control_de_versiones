<?php
class Rutas{
    protected $urlBase = "http://localhost/edufast/administrador/";

    public function __construct(){

    }

    //METODO ONTENER URL BASE
    public function obtenerUrlBase(){
return $this->urlBase;
    }

    //METODO  OBTENER MENU INICIO
  

    //Metodo obtener  menu nuevo
    public function obtenerMenuNuevo(){
        return '<a href="'.htmlspecialchars($this->urlBase .'/vistas/actualizar_evento.php'). '">Evento</a>';
    }

    //METODO OBTENER MENU MODIFIACR

    // Método obtener menú modificar
public function obtenerMenuModificar($id) {
    return '<a href="'.htmlspecialchars($this->urlBase .'/cliente/modificar.php?id='.urlencode($id)). '">Modificar</a>';
}

// Método obtener menú eliminar
public function obtenerMenuEliminar($id) {
    return '<a href="'.htmlspecialchars($this->urlBase .'/cliente/eliminar.php?id='.urlencode($id)). '">Eliminar</a>';
}

    



}
?>