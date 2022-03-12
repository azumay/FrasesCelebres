<?php

class FraseModel{

    
    public function __construct(){
     
	}
	
    public function mostrar($limiteXPagina) {
        $getFrases=[];
        $dsn = "mysql:host=localhost;charset=UTF8;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        $selectFrases = $dbh ->query("select * from Frase LIMIT 15 OFFSET " . $limiteXPagina);

       foreach ($selectFrases->fetchAll(PDO::FETCH_ASSOC) as $resultado) {
            $getFrase = new Frase();
                $getFrase->setId($resultado["id"]);
                $getFrase->setTexto($resultado["texto"]);
                $getFrase ->setTema($resultado["tema_id"]);
                $getFrase ->setAutor($resultado["autor_id"]);
            $getFrases[] = $getFrase;
        }

        return $getFrases;
        
    }

    public function create(Frase $fraseToCreate){
		
      
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        $queryFrase = $dbh->prepare ( "insert into Frase (texto, autor_id) values(?, ?);" );
             
        
        $params = array (
            utf8_decode ( $fraseToCreate->getTexto() ),
            utf8_decode ( $fraseToCreate->getAutor() ),
            //utf8_decode ( $fraseToCreate->getId() ) 
            );

 
        
        $queryFrase->execute ( $params );
        	
        



    }
   

}
