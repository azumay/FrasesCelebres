<?php

class TemaModel{

    
    
    public function __construct(){
     
	}
	

    public function mostrar() {
        $getTemas=[];
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        $selectTemas = $dbh ->query("select * from Tema;");

       foreach ($selectTemas->fetchAll(PDO::FETCH_ASSOC) as $resultado) {
            $getTema = new Tema();
                $getTema->setId($resultado["id"]);
                $getTema ->setNombre(utf8_decode($resultado["nombre"]));
            $getTemas[] = $getTema;
        }

        return $getTemas;
        
    }
    public function eliminar($id) {

        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
       
        $eliminar = $dbh->query("DELETE FROM Tema WHERE id = $id");
       
    }

    public function create(Tema $temaToCreate){
		
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        
        $queryTema = $dbh->prepare ("insert into Tema (id, nombre) values(?, ?);" );
             
        
        $params = array (
             $temaToCreate->getId()     ,
             $temaToCreate->getNombre() ,
            );

 
        $queryTema->execute ( $params );
        	
        
        return $dbh->lastInsertId();


    }
   

}
