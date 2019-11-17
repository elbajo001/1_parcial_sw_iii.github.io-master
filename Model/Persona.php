<?php
class Persona {

    public $perIdentificacion;
    public $perNombre;
    public $perTareas = array();

    public function __construct($parIdentificacion, $parNombre, $parTareas){
        $this->perIdentificacion = $parIdentificacion;
        $this->perNombre = $parNombre;
        $this->perTareas = $parTareas;
    }

    #Funcion que recibe un objeto de tipo Tarea e internamente se le agrega al array perTareas
    public function agregarTarea($parTarea){
        array_push($this->perTareas,$parTarea);
    }

    public function getIdentificacion(){
        return $this->perIdentificacion;
    }

    public function setIdentificacion($parIdentificacion){
        $this->perIdentificacion = $parIdentificacion;
    }

    public function getNombre(){
        return $this->perNombre;
    }

    public function setNombre($parNombre){
        $this->perNombre = $parNombre;
    }

    public function getTareas(){
        return $this->perTareas;
    }

    public function getTareaPorId($index){
        return $this->perTareas;
    }

    


}