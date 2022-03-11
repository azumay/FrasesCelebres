<?php

class FraseModel{

    
    public function __construct(){
     
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
