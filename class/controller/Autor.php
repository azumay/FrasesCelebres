<?php

class Autor{
  
    private $id;
    private $url;
    private $nombre;
    private $descripcion;
    
 
    public function getUrl(){
        return $this->url;
    }
    public function getTema() {
        return $this->tema;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setTema($tema) {
        $this->tema = $tema;
    }
    public function setUrl($url) {
        $this->url = $url;
    }

}
