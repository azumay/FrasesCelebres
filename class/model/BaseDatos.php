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
        $conn->exec("create database FrasesAutor; ");

        $conn->exec("use FrasesAutor; ");

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
				id			int  	primary key,
			 	texto		text 		not null,
			 	tema_id		int     references tema(id),
				autor_id	int		references autor(id));"
        );

    }

    public function insertAutor($datos)
    {

        $mAutor = new AutorModel();

        /*echo "<pre>";
        var_dump($datos);
        echo "</pre>";*/

        foreach ($datos->autor as $autor) {
        

		/*	echo "<pre>";
			//var_dump($autor->nombre->__toString(), $autor->descripcion->__toString());
			echo "</pre>";
		*/	

		//Autor:	
			//echo "<pre>";
            //var_dump($autor->attributes()["url"]->__toString());
            //var_dump($autor->descripcion->__toString());
            //echo "</pre>";

        $objAutor = new Autor ();
			$objAutor->setUrl(utf8_decode($autor->attributes()["url"]->__toString()));
			$objAutor->setNombre(utf8_decode($autor->nombre->__toString()));
			$objAutor->setDescripcion(utf8_decode($autor->descripcion->__toString()));

            $mAutor->create($objAutor);

			

		//Frases:	
            //echo "<pre>";
            //var_dump($autor->frases);
            //var_dump($autor->nombre->__toString());
            //echo "</pre>";
            //foreach ($autor->frases as frase) {}

        }
    }

}
