<?php


class BaseDatos {

    private $servidor;
	private $usuario;
	private $password;
	private $baseDades;
	private $dbType;

	
	static $_instance;
	
	/**
	 * El constructor de l'objecte eś privat per evitar que pugui ser creat mitjançant un new.
	 */
	 function __construct() {
		$this->datosConexion();
		
	}
	
    private function datosConexion() {
		$config = Configuracio::getInstance ();
		
		$this->servidor = $config->getDbServidor ();
		
		$this->usuario = $config->getUserDB ();

		$this->password = $config->getPassDB ();
		
		$this->baseDades = $config->getDbBaseDeDades();
		
		$this->dbType = $config->getDbType();
		
	}

    public static function getInstance() {
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}

	public function loadDatosDB(){

		//Zona de conexión DB
		$conexion = $this->dbType.":host=". $this->servidor . ";dbname=".$this->baseDades;
		$conn = new PDO ( $conexion, $this->usuario, $this->password );

		//Zona de Sentencias SQL
		$datosXML = new AutorModel();
		$datosXML -> loadingData();


	}

	public function createDB() {
			
		//Zona de conexión DB
			$conexion = $this->dbType.":host=". $this->servidor . ";dbname=".$this->baseDades;
			$conn = new PDO ( $conexion, $this->usuario, $this->password );
			
		//Zona de Sentencias SQL	
			$conn->exec ( "drop database if exists FrasesAutor;" );
			$conn->exec ( "create database FrasesAutor; ");

				$conn->exec ( "use FrasesAutor; ");

			$conn->exec (
				"create table Tema(
			 	id			integer  	primary key,
 				nombre		varchar(75) not null);"
			);

			$conn->exec ( 
				"create table Autor (
			 	id			integer  	 primary key,
			 	nombre		varchar(75)  not null,
			 	descripcion varchar(150) not null);"
			);
			
			$conn->exec (
				"create table Frase (
				id			integer  	primary key,
			 	texto		text 		not null,
			 	tema_id		integer     references tema(id),
				autor_id	integer		references autor(id));"
 			);

		}
	
    


}