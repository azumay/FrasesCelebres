<?php
class UsuarioView extends View {
    private $_user;
    
    public function __construct(Usuario $param=null) {
        parent::__construct();
        if (isset($param)) {
            $this->_user=$param;
        } else {
            $this->_user=new Usuario();
        }
    }
    
    public function login($errorsDetectats=null) {
        require_once $file=$this->fitxerDeTraduccions();
        $html_opacityLang[$this->getIdioma()]="style=\"opacity:1;\"";
        
        if (isset($this->_user)) {
            $frmNom=$this->_user->getEmail();
            $frmContrasenya=$this->_user->getPassword();
        }
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        include "templates/tpl_body_login.php";
        
        include "templates/tpl_footer.php";
    }
    
    
    
    public function register($errorsDetectats=null) {
        $sEmail = $this->_user->getEmail();
        $sPassword = $this->_user->getPassword();
        $cPassword = $this->_user->getPassword();
        
        $sTipus = $this->_user->getTipusIdent();
        $sDni = $this->_user->getNumeroIdent();
        $sNom = $this->_user->getNom();
        $sCognoms = $this->_user->getCognoms();
        $sSexe = $this->_user->getSexe();
        $dNaixement = $this->_user->getDatanaixement();
        
        $sAdreca = $this->_user->getAdreca();
        $sCP = $this->_user->getCodiPostal();
        $sPoblacio = $this->_user->getPoblacio();
        $sProvincia = $this->_user->getProvincia();
        $sTelefon = $this->_user->getTelefon();
        
        $options = ["type"=>"text",
            "name"=>"email",
            "placeholder"=>"email (Obligatori)",
            "class"=>"llarg",
            "value"=> $sEmail,
            "span"=> $errorsDetectats["email"] ];
        $input_email = $this->html_generaInput($options);
        
        $options = [
            "type"=>"password",
            "name"=>"pass",
            "placeholder"=>"Contrasenya (Obligatori)",
            "class"=>"llarg",
            "value"=>$sPassword,
            "span"=>$errorsDetectats["pass"] ];
        $input_pass = $this->html_generaInput($options);
        
        $options = [
            "type"=>"password",
            "name"=>"cpass",
            "placeholder"=>"Confirma la contrasenya (Obligatori)",
            "class"=>"llarg",
            "value"=>$cPassword,
            "span"=>$errorsDetectats["cpass"] ];
        $input_cpass = $this->html_generaInput($options);
        
        $options = [
            "type"=>"button",
            "name"=>"next",
            "class"=>"next action-button",
            "value"=>"Next" ];
        $input_bNext = $this->html_generaInput($options);
        
        $atributs = [
            "class"=>"curt",
            "name"=>"tipus",
            "span"=>$errorsDetectats["tipus"] ];
        $opcions = [
            "NIF"=>"NIF: N??mero d'Identificaci?? Fiscal",
            "NIE"=>"NIE: N??mero d'Identificaci?? d'Extranjers",
            "PAS"=>"PAS: Passaport" ];
        $seleccionat = (isset($sTipus)) ? $sTipus : "NIF";
        $select_Tipus = $this->html_generateSelect($opcions, $seleccionat, $atributs);
        
        $options = [
            "type"=>"text",
            "name"=>"dni",
            "placeholder"=>"DNI (Obligatori)",
            "class"=>"curt",
            "value"=> $sDni,
            "span"=>$errorsDetectats["dni"] ];
        $input_dni = $this->html_generaInput($options);
        
        $options = [
            "type"=>"text",
            "name"=>"nom",
            "placeholder"=>"Nom (Obligatori)",
            "class"=>"llarg",
            "value"=>$sNom,
            "span"=>$errorsDetectats["nom"] ];
        $input_nom = $this->html_generaInput($options);
        
        $options = [
            "type"=>"text",
            "name"=>"cognoms",
            "placeholder"=>"Cognoms (Obligatori)",
            "class"=>"llarg",
            "value"=>$sCognoms,
            "span"=>$errorsDetectats["cognoms"] ];
        $input_cognoms = $this->html_generaInput($options);
        
        $opcions = [
            "sexe1" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "H",
                "checked"=>($sSexe=="H") ? true : false,
                "label"=>"Home" ] ,
            "sexe2" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "D",
                "checked"=>($sSexe=="D") ? true : false,
                "label"=>"Dona" ]
        ];
        $select_Sexe = $this->html_generateRadioButon($opcions);
        
        $options = [
            "type"=>"text",
            "name"=>"naixement",
            "placeholder"=>"Data de naixement (Obligatori)",
            "class"=>"llarg",
            "value"=>$dNaixement,
            "span"=>$errorsDetectats["dNaixement"] ];
        $input_naixement = $this->html_generaInput($options);
        
        $options = [
            "type"=>"button",
            "name"=>"previous",
            "class"=>"previous action-button",
            "value"=>"Previous" ];
        $input_bPrev = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "name"=>"adreca",
            "placeholder"=>"Adre??a",
            "value"=>$sAdreca,
            "span"=>$errorsDetectats["adreca"] ];
        $input_adreca = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"cp",
            "placeholder"=>"C.P.",
            "value"=>$sCP,
            "span"=>$errorsDetectats["cp"] ];
        $input_cp = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"poblacio",
            "placeholder"=>"Poblaci??",
            "value"=>$sPoblacio,
            "span"=>$errorsDetectats["poblacio"] ];
        $input_poblacio = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"provincia",
            "placeholder"=>"Provincia",
            "value"=>$sProbincia,
            "span"=>$errorsDetectats["provincia"] ];
        $input_provincia = $this->html_generaInput($options);
        
        $options = [
            "class"=>"llarg",
            "class"=>"curt",
            "name"=>"telefon",
            "placeholder"=>"Tel??fon",
            "value"=>$sTelefon,
            "span"=>$errorsDetectats["telefon"] ];
        $input_telefon = $this->html_generaInput($options);
        
        $options = [
            "type"=>"hidden",
            "name"=>"MAX_FILE_SIZ",
            "value"=>"2097152" ];
        $input_maxFileSize = $this->html_generaInput($options);
        
        $options = [
            "type"=>"file",
            "class"=>"llarg",
            "name"=>"imatge",
            "id"=>"imatge",
            "value"=>$sImatge,
            "span"=>$errorsDetectats["imatge"] ];
        $input_imatge = $this->html_generaInput($options);
        
        $options = [
            "type"=>"submit",
            "name"=>"submit",
            "class"=> "submit action-button",
            "value"=> "Envia Dades"];
        $input_bSend = $this->html_generaInput($options);
        
        require_once $file=$this->fitxerDeTraduccions();
        $html_opacityLang[$this->getIdioma()]="style=\"opacity:1;\"";
        
        if (isset($this->_user)) {
            $frmNom=$this->_user->getEmail();
            $frmContrasenya=$this->_user->getPassword();
        }
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        include "templates/tpl_body_register.php";
        
        include "templates/tpl_footer.php";
    }
}