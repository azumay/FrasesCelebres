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

    public function mostrar() {
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        
        $selectAutores = $dbh ->prepare('SELECT * FROM Autor');

        $autoresShow = $selectAutores -> execute();

        return $autoresShow;
        
    }



    public function create(Autor $autorToCreate){
		
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        //select max id BD y le sumo 1 to autor
        //$idAutor = $dbh->prepare("SELECT MAX(id) FROM Autor");
        //$idAutor->execute();
        
        /*  if( $idAutor->fetch()[0] == NULL ){
                $idAutor = 1;
             }else{
                $idAutor++;
             }
        */
        $queryAutor = $dbh->prepare ("insert into Autor (url, nombre, descripcion) values(?,?,?);" );
             
        
        $params = array (
            utf8_decode ( $autorToCreate->getUrl() ),
            utf8_decode ( $autorToCreate->getNombre() ),
            utf8_decode ( $autorToCreate->getDescripcion() ) 
            );

 
        $queryAutor->execute ( $params );
        	
        
        return $dbh->lastInsertId();


    }
   

}
