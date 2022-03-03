<?php


class BaseDatos {

    private $servidor;
	private $usuario;
	private $password;
	private $baseDades;
	private $dbType;
	private $link;
	private $stmt;
	private $array;
	static $_instance;
	
	/**
	 * El constructor de l'objecte eś privat per evitar que pugui ser creat mitjançant un new.
	 */
	private function __construct() {
		$this->datosConexion();
		$this->conectar();
	}
	
    private function datosConexion() {
		$config = Configuracio::getInstance ();
		
		$this->servidor = $config->getHostDB ();
		$this->baseDades = $config->getDB ();
		$this->usuario = $config->getUserDB ();
		$this->password = $config->getPassDB ();
		$this->dbType = $config->getDBtype ();
	}

    public static function getInstance() {
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	
    private function conectar() {
		try {
			$dsn = $this->dbType . ":dbname=" . $this->baseDades . ";host=" . $this->servidor;
			$this->link = new PDO ( $dsn, $this->usuario, $this->password );
		} catch ( PDOException $e ) {
			$error = "Ha habido un error: " . $e->getMessage ();
			include "/class/view/ErrrorView.php";
		}
	}

    public function executar($sSql, $sParams) {
		try {
			$this->stmt = $this->link->prepare ( $sSql );
			$this->stmt->execute ($sParams);
			$res = $this->stmt->fetchAll();
			return $res;
		} catch ( PDOException $e ) {
			$error = "Ha habido un error: " . $e->getMessage ();
			include "/class/view/ErrrorView.php";
		}
	}


}