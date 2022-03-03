<?php
class Configuracio
{

    //Dades de configuració per accés a base de dades
    private $_dbServidor;
    private $_dbUser;
    private $_dbPassword;
    private $_dbBaseDeDades;
    private $_dbType;

    private static $_instance;

    private function __construct()
    {
        include "config.php";

        /*Dades conexio base de dades*/
        $this->_dbServidor = $host;
        $this->_dbUser = $user;
        $this->_dbPassword = $password;
        $this->_dbBaseDeDades = $dbBaseDeDades;
        $this->_dbType = $dbtype;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function clone () {
    }

    public function getDbServidor()
    {
        return $this->_dbServidor;
    }

    public function getUserDB()
    {
        return $this->_dbUser;
    }

    public function getPassDB()
    {
        return $this->_dbPassword;
    }

    public function getDbPassword()
    {
        return $this->_dbPassword;
    }

    public function getDbBaseDeDades()
    {
        return $this->_dbBaseDeDades;
    }
    public function getDbType()
    {
        return $this->_dbType;
    }


}
