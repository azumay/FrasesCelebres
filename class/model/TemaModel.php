<?php

class TemaModel{

    
    
    public function __construct(){
     
	}
	

    public function mostrar($limiteXPagina) {
        $getTemas=[];
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        $selectTemas = $dbh ->query("select * from Tema LIMIT 15 OFFSET " . $limiteXPagina);

       foreach ($selectTemas->fetchAll(PDO::FETCH_ASSOC) as $resultado) {
            $getTema = new Autor();
                //$getTema->setId($resultado["id"]);
                $getTema ->setNombre($resultado["nombre"]);
            $getTemas[] = $getTema;
        }

        return $getTemas;
        
    }



    public function create(Tema $temaToCreate){
		
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        
        $queryTema = $dbh->prepare ("insert into Tema (nombre) values(?);" );
             
        
        $params = array (
            //utf8_decode ( $temaToCreate->getUrl() ),
            utf8_decode ( $temaToCreate->getNombre() ),
            );

 
        $queryTema->execute ( $params );
        	
        
        return $dbh->lastInsertId();


    }
   

}
