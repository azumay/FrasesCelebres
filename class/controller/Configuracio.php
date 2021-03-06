<?php
class Configuracio {
    private $_directoriDePujades;			//carpeta on emmagatzemearem les imatges pujades pels usuaris
    private $_formatsImatgesPermesos;	  	//formats permesos
    private $_mimesImatgesPermesos;
    
    //Dades de configuració per accés a base de dades
    private $_dbSQBD;
    private $_dbServidor;
    private $_dbUsernamePerConsultes;
    private $_dbUsernamePerAccions;
    private $_dbPassword;
    private $_dbBaseDeDades;
    private $_registroPerPagina;
    private static $_instance;
    
    
    private function __construct(){
        include "config.php";
        
        $this->_directoriDePujades = $directoriDePujades;
        $this->_formatsImatgesPermesos = $formatsImatgesPermesos;
        $this->_mimesImatgesPermesos = $mimesImatgesPermesos;
        $this->_dbServidor = $dbServidor;
        $this->_dbUsernamePerConsultes = $dbUsernamePerConsultes;
        $this->_dbUsernamePerAccions = $dbUsernamePerAccions;
        $this->_dbPassword = $dbPassword;
        $this->_dbBaseDeDades = $dbBaseDeDades;      
        $this->_dbSQBD=$dbSGBD;
        $this->_registroPerPagina= $registresPexPagina;
    }
    
    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }
    
    public function __clone() {   
    }
    /**
     * @return mixed
     */
    public function getDirectoriDePujades()
    {
        return $this->_directoriDePujades;
    }

    public function getRegistroPerPagina ()
    {
        return $this->_registroPerPagina;
    }

    /**
     * @return mixed
     */
    public function getFormatsImatgesPermesos()
    {
        return $this->_formatsImatgesPermesos;
    }

    /**
     * @return mixed
     */
    public function getMimesImatgesPermesos()
    {
        return $this->_mimesImatgesPermesos;
    }

    /**
     * @return mixed
     */
    public function getDbServidor()
    {
        return $this->_dbServidor;
    }

    /**
     * @return mixed
     */
    public function getDbUsernamePerConsultes()
    {
        return $this->_dbUsernamePerConsultes;
    }

    /**
     * @return mixed
     */
    public function getDbUsernamePerAccions()
    {
        return $this->_dbUsernamePerAccions;
    }

    /**
     * @return mixed
     */
    public function getDbPassword()
    {
        return $this->_dbPassword;
    }

    /**
     * @return mixed
     */
    public function getDbBaseDeDades()
    {
        return $this->_dbBaseDeDades;
    }
    /**
     * @return mixed
     */
    public function getDbSQBD()
    {
        return $this->_dbSQBD;
    }

    /**
     * @param mixed $_dbSQBD
     */
    public function setDbSQBD($_dbSQBD)
    {
        $this->_dbSQBD = $_dbSQBD;
    }

    
    

 }

