<?php

class AutorModel{

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

    public function mostrar($limiteXPagina) {
        $getAutores=[];
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        $selectAutores = $dbh ->query("select * from Autor LIMIT 15 OFFSET " . $limiteXPagina);

       foreach ($selectAutores->fetchAll(PDO::FETCH_ASSOC) as $resultado) {
            $getAutor = new Autor();
                $getAutor->setId($resultado["id"]);
                $getAutor ->setUrl(utf8_decode($resultado["url"]));
                $getAutor ->setNombre(utf8_decode($resultado["nombre"]));
                $getAutor ->setDescripcion(utf8_decode($resultado["descripcion"]));
            $getAutores[] = $getAutor;
        }

        return $getAutores;
        
    }



    public function create(Autor $autorToCreate){
		
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        
        $queryAutor = $dbh->prepare ("insert into Autor (url, nombre, descripcion) values(?,?,?);" );
             
        
        $params = array (
              $autorToCreate->getUrl() ,
              $autorToCreate->getNombre() ,
              $autorToCreate->getDescripcion()  
            );

 
        $queryAutor->execute ( $params );
        	
        
        return $dbh->lastInsertId();


    }
   

}
