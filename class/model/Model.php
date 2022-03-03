<?php

class Model {
    protected $config;
    protected $queryLink;
    protected $actionLink;
    
    protected static $_instance;

    private function __construct() {
        $this->config = Configuracio::getInstance();

        switch ($this->config->getDbSQBD()) {
            case "mysql":
                if ($link = new mysqli($this->config->getDbServidor(), $this->config->getDbUsernamePerConsultes(), $this->config->getDbPassword(), $this->config->getDbBaseDeDades())) {
                    $this->queryLink = $link;
                } else {
                    throw new Exception("problemes de conexxió a BBDD. Error: " . $link->connect_errno);
                }
                if ($link = new mysqli($this->config->getDbServidor(), $this->config->getDbUsernamePerAccions(), $this->config->getDbPassword(), $this->config->getDbBaseDeDades())) {
                    $this->actionLink = $link;
                } else {
                    throw new Exception("problemes de conexxió a BBDD. Error: " . $link->connect_errno);
                }
                break;
            case "postgre":
                $link = pg_connect("host=" . $this->servidor . " dbname=" . $this->baseDades . " user=" . $this->usuari . " password=" . $this->password);
                break;
            case "sqlserver":
                $link = sqlsrv_connect($this->servidor, array(
                    "Database" => $this->baseDades,
                    "UID" => $this->usuari,
                    "PWD" => $this->password,
                    "CharacterSet" => "UTF-8"
                ));
                break;
        }
    }

    public function __destruct() {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                $this->queryLink->close();
                $this->actionLink->close();
                break;
            case "postgre":
                $result = pg_close($this->link);
                break;
            case "sqlserver":
                sqlsrv_close($this->link);
                break;
        }
    }

    public static function getInstance() {
        if (! (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Realitza consultes sql a la base de dades.
     *
     * @param String $sql
     *            String amb la sentencia sql que volem esecutar
     * @param Array $parametres
     *            Conjunt de paràmetres de ls sentència Sql.
     * @return mixed recurs[Resource] on s'enmagatzema el resultat de la consulta
     */
    public function execute($sentencia, $parametres, $conexcio = "consulta") {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                if ($conexcio == "consulta") {
                    if ($stmt = $this->queryLink->prepare($sentencia)) {

                        if ($res = call_user_func_array(array(
                            $stmt,
                            'bind_param'
                        ), $this->refValues($parametres))) {
                            if ($res = $stmt->execute()) {
                                $dades = $stmt->get_result();
                            }
                        }
                    }
                } else {
                    if ($stmt = $this->actionLink->prepare($sentencia)) {

                        if ($res = call_user_func_array(array(
                            $stmt,
                            'bind_param'
                        ), $this->refValues($parametres))) {
                            if ($res = $stmt->execute()) {
                                $dades = $res;
                            } else {
                                throw new Exception("No s'ha pogut actualitzar -> " . $stmt->error);
                            }
                        }
                    }
                }
                break;
            case "postgre":
                $this->stmt = pg_query($this->link, $sql);
                break;
            case "sqlserver":
                $this->stmt = sqlsrv_query($this->link, $sql);
                break;
        }
        return $dades;
    }

    /**
     * Obetenció d'una fila de resultats d'una sentencia sql
     *
     * @param mysqli_result $result
     *            recurs[Resource] on s'enmagatzema el resultat de la consulta i hem obtingut
     *            amb la funció ejecutar(sql)
     * @param integer $fila
     *            Numero de fila que volem recuperar.
     *            0 -> seqüencial, una fila rera l'altre.
     *            num -> una fila específica.
     * @return multitype: array amb els resultats en forma d'objecte.
     */
    public function obtenir_fila(mysqli_result $result, $fila) {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                if ($fila != 0) {
                    $result->data_seek($fila);
                }
                break;
            case "postgre":
                if ($fila == 0) {
                    pg_fetch_row($stmt);
                }
                $result = pg_fetch_row($stmt, $fila);
                break;
            case "sqlserver":
                if ($fila == 0) {
                    sqlsrv_fetch_array($stmt);
                }
                $resultsqlsrv_fetch_array($stmt, "SQLSRV_FETCH_ASSOC", $fila, 1);
                break;
        }
        return $result->fetch_object();
    }

    public function numeroDeFiles($result)
    {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                $result = $result->num_rows;
                break;
            case "postgre":
                $result = pg_num_rows();
                break;
            case "sqlserver":
                $result = sqlsrv_num_rows();
                break;
        }
        return $result;
    }

    public function getLastError()
    {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                if (isset($this->queryLink->errno)) {
                    $result=$this->queryLink->errno;
                } else {
                    $result=$this->actionLink->errno;
                }
                break;
            case "postgre":
                $result = pg_last_error($this->link);
                break;
            case "sqlserver":
                $result = sqlsrv_errors();
                break;
        }
        return $result;
        
    }

    public function getLastId()
    {
        switch ($this->config->getDbSQBD()) {
            case "mysql":
                $result = $this->actionLink->insert_id;
                break;
            case "postgre":
                $result = pg_last_oid($this->link);
                break;
            case "sqlserver":
                $result = sqlsrv_insert_id();
                break;
        }
        return $result;

    }

    private function refValues($arr)
    {
        $refs = array();
        foreach ($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }

    public function clone()
    {}
}

