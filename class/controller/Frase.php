<?php

class Frase{
    private $id;
    private $texto;
    private $tema;
    private $autor;
  
    
 
    public function getId(){
        return $this->id;
    }

    public function getTexto(){
        return $this->texto;
    }
   
    public function getAutor(){
        return $this->autor;
    }
    
    public function getTema(){
        return $this->tema;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }
    public function setAutor($autor) {
        $this->autor = $autor;
    }
    
    public function setTema($tema) {
        $this->tema = $tema;
    }
    public function setId($id) {
        $this->id = $id;
    }
    

}
