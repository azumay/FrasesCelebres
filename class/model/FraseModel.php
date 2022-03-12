<?php

class FraseModel{

    
    public function __construct(){
     
	}
	
    public function mostrar() {
        $getFrases=[];
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
        $selectFrases = $dbh ->query("select * from Frase;");

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

    public function eliminar($id) {

        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");
       
        $eliminar = $dbh->query("DELETE FROM Frase WHERE id = $id");
       
    }

    public function create(Frase $fraseToCreate){
		
      
        $dsn = "mysql:host=localhost;dbname=FrasesAutor";
        $dbh = new PDO($dsn, "yamuza", "yamuza");

        $queryFrase = $dbh->prepare ( "insert into Frase (texto, autor_id, tema_id) values(?, ?, ?);" );
             
        
        $params = array (
              $fraseToCreate->getTexto() ,
              $fraseToCreate->getAutor() ,
              $fraseToCreate->getId()    ,
            );

 
        
        $queryFrase->execute ( $params );
        	
        



    }
   

}
