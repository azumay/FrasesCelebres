<?php

class AutorModel{
  
    private $id;
    private $nombre;
    private $descripcion;
    private $texto;
    private $tema;

    private $fichero;
    private $contenido;
    
    public function __construct(){
		$this->fichero = "Datos/frases.xml";
     
	}
	
	public function loadingData(){
     
		$this -> contenido = simplexml_load_file($this->fichero);
        //echo "<pre>";
        //var_dump($this->contenido);
        //echo "</pre>";
		return $this -> contenido;

	}

    public function getTexto() {
        return $this->texto;
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
    public function setTexto($texto) {
        $this->texto = $texto;
    }
    public function setTema($tema) {
        $this->tema = $tema;
    }

}
