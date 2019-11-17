<?php

class Tarea{
    
    public $tarDescripcion;
    public $tarFecha;
    public $tarRealizada;

    public function __construct($parDescripcion, $parFecha, $parEstado){
        $this->tarDescripcion = $parDescripcion;
        $this->tarRealizada = $parEstado;
        $this->tarFecha = $parFecha;
    }

    public function getTarRealizada(){
        return $this->tarRealizada;
    }

    public function setTarRealizada($parRealizada){
        $this->tarRealizada = $parRealizada;
    }

    public function getTarFecha(){
        return $this->tarFecha;
    }

    public function setTarFecha($parFecha){
        $this->tarFecha = $parFecha;
    }

    public function getTarDescripcion(){
        return $this->tarDescripcion;
    }

    public function setTarDescripcion($parDescripcion){
        $this->tarDescripcion = $parDescripcion;
    }
}