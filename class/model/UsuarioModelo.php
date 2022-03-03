<?php
class UsuarioModelo extends Model {

    function __construct() {
        $this->config=parent::getInstance()->config;
        $this->queryLink=parent::getInstance()->queryLink;
        $this->actionLink=parent::getInstance()->actionLink;
    }
    
    public function getByEmail(Usuario $oUsuario) {        
        $sSql = "SELECT * FROM tbl_usuaris WHERE email=? AND password=? AND status=?;";
        $parametros=array("ssi", $oUsuario->getEmail(), $oUsuario->getPassword(),1);
        
        if (! ($result = $this->execute($sSql, $parametros))) {
            $retorn['bbdd'] = "</br> Error 006 - Problema a l'executar la sentencia: <br> $sSql <br>".mysqli_error($this->queryLink);
        } else if (($nfilas = $this->numeroDeFiles($result)) === 0) {
            $retorn['bbdd'] = "</br> Error 007 - La combinació d'usuari i contrasenya no existeix o no està l'uausri actiu <br>";
        } else {
            $retorn = $result->fetch_object("Usuario");
        }
        return $retorn;
    }
    
    public function confirma(Usuario $usuario) {        
        $sSql = "UPDATE tbl_usuaris SET status=1, dataDarrerAcces=CURRENT_TIMESTAMP WHERE id=?" ;
        $parametres = array("s",$usuario->getId());
        
        if (! $this->execute($sSql, $parametres, "accio")) {
            $errorsDetectats["baseDades"] = "Hi ha un error en al consulta a la BBDD: " . $idConnexioPerAccions->getLastError();
        }
        return $errorsDetectats;
    }
    
    public function isEmailUnic(Usuario $oUser) {
         $sSql = "SELECT COUNT(*) AS res FROM tbl_usuaris WHERE email = ?";
         $parametres = array("s", $oUser->getEmail());
         
         if ($resultatConsulta = $this->execute($sSql, $parametres)) {
            $registreResultat = $this->obtenir_fila($resultatConsulta, 0);
            if ($registreResultat->res == 0) {
                return true;
            } else {
                return false;
            }
         } 
    }
    
    public function save(Usuario $usuario) {
        $sSql = "INSERT INTO tbl_usuaris (id, email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, datanaixement, adreca, codiPostal, poblacio, provincia, telefon, imatge, status, navegador, plataforma, dataCreacio, dataDarrerAcces)";
        $sSql .= "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
        
        $telef=($usuario->getTelefon()=="") ? null : $usuario->getTelefon();        
        $sParam = array(
            "ssssssssssssssss",
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getTipusIdent(),
            $usuario->getNumeroIdent(),
            $usuario->getNom(),
            $usuario->getCognoms(),
            $usuario->getSexe(),
            $usuario->getDatanaixement(),
            $usuario->getAdreca(),
            $usuario->getCodiPostal(),
            $usuario->getPoblacio(),
            $usuario->getProvincia(),
            $telef ,
            $usuario->getImatge(),
            $usuario->getNavegador(),
            $usuario->getPlataforma()
        );
        
        if ($resultatConsulta = $this->execute($sSql, $sParam, "action")) {
            return $this->getLastId();            
        } else {
            return $errorsDetectats["baseDades"] = "Hi ha un error en al consulta a la BBDD: " . $this->getLastError();
        }

    }
}

