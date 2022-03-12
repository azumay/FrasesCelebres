<?php

class BaseDatos
{

    private $servidor;
    private $usuario;
    private $password;
    private $baseDades;
    private $dbType;

    static $_instance;

    /**
     * El constructor de l'objecte eś privat per evitar que pugui ser creat mitjançant un new.
     */
    public function __construct()
    {
        $this->datosConexion();

    }

    private function datosConexion()
    {
        $config = Configuracio::getInstance();

        $this->servidor = $config->getDbServidor();

        $this->usuario = $config->getUserDB();

        $this->password = $config->getPassDB();

        $this->baseDades = $config->getDbBaseDeDades();

        $this->dbType = $config->getDbType();

    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function createDB()
    {

        //Zona de conexión DB
        $conexion = $this->dbType . ":host=" . $this->servidor . ";dbname=" . $this->baseDades;
        $conn = new PDO($conexion, $this->usuario, $this->password);

        //Zona de Sentencias SQL
        $conn->exec("drop database if exists FrasesAutor;");
        $conn->exec("create database FrasesAutor;");

        $conn->exec("use FrasesAutor;");

        $conn->exec(
            "create table Tema(
			 	id			int  	primary key,
 				nombre		varchar(75) not null);"
        );

        $conn->exec(
            "create table Autor (
			 	id			int  	 primary key AUTO_INCREMENT,
				url			varchar(150)	null,
			 	nombre		varchar(75)  not null,
			 	descripcion varchar(150)  null);"
        );

        $conn->exec(
            "create table Frase (
				id			int  	 primary key AUTO_INCREMENT,
			 	texto		text 	 not null,
			 	autor_id	int	     not null,
                tema_id		int      null);"
        );

    }

    public function insertAutor($datos)
    {

        $mAutor = new AutorModel();
        $mFrase = new FraseModel();

    foreach ($datos->autor as $autor) {

	//Autor:	
       $objAutor = new Autor ();

			$objAutor->setUrl(utf8_decode($autor->attributes()["url"]->__toString()));
			$objAutor->setNombre(utf8_decode($autor->nombre->__toString()));
			$objAutor->setDescripcion(utf8_decode($autor->descripcion->__toString()));

            $autor_id = $mAutor->create($objAutor);
            $objAutor->setId($autor_id); //Guardo el ID en el obj Autor

    
if (isset($autor->frases->frase)){ //Si existe frase en ese Autor lo guardamos
	
    foreach ($autor->frases as $frase) {

	//Frases:			
		$objFrase = new Frase ();
        
            $objFrase ->setAutor(intval($autor_id));
		    $objFrase ->setTexto(utf8_decode($frase->children()[0]->children()[0]->__toString()));
            
            $mFrase->create($objFrase);
			
            //$frase->children()[0]->children()[1]->__toString())
		
            //var_dump($objFrase->getAutor());

			

			}
        }
            
    }
         /*	
                $oTema = $mTemas->getOneByName($tema);
                if (!isset($oTema)) {
                    $oTema = new Tema($tema);
                    $tema_id = $mTemas->create($oTema);
                    $oTema->setId($tema_id);
                    }
                */
    
    }   
    
}