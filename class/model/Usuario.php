<?php
class Usuario{
        private $id;
        private $email;
        private $password;
        private $tipusIdent;
        private $numeroIdent;
        private $nom;
        private $cognoms;
        private $sexe;
        private $datanaixement;
        private $adreca;
        private $codiPostal;
        private $poblacio;
        private $provincia;
        private $telefon;
        private $imatge;
        private $status;
        private $navegador;
        private $plataforma;
        private $dataCreacio;
        private $dataDarrerAcces;
        
        public $errorsDetectats;
        
        public function __construct() {}
        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }
        
        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }
        
        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->password;
        }
        
        /**
         * @return mixed
         */
        public function getTipusIdent()
        {
            return $this->tipusIdent;
        }
        
        /**
         * @return mixed
         */
        public function getNumeroIdent()
        {
            return $this->numeroIdent;
        }
        
        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->nom;
        }
        
        /**
         * @return mixed
         */
        public function getCognoms()
        {
            return $this->cognoms;
        }
        
        /**
         * @return mixed
         */
        public function getSexe()
        {
            return $this->sexe;
        }
        
        /**
         * @return mixed
         */
        public function getDatanaixement()
        {
            return $this->datanaixement;
        }
        
        /**
         * @return mixed
         */
        public function getAdreca()
        {
            return $this->adreca;
        }
        
        /**
         * @return mixed
         */
        public function getCodiPostal()
        {
            return $this->codiPostal;
        }
        
        /**
         * @return mixed
         */
        public function getPoblacio()
        {
            return $this->poblacio;
        }
        
        /**
         * @return mixed
         */
        public function getProvincia()
        {
            return $this->provincia;
        }
        
        /**
         * @return mixed
         */
        public function getTelefon()
        {
            return $this->telefon;
        }
        
        /**
         * @return mixed
         */
        public function getImatge()
        {
            return $this->imatge;
        }
        
        /**
         * @return mixed
         */
        public function getStatus()
        {
            return $this->status;
        }
        
        /**
         * @return mixed
         */
        public function getNavegador()
        {
            return $this->navegador;
        }
        
        /**
         * @return mixed
         */
        public function getPlataforma()
        {
            return $this->plataforma;
        }
        
        /**
         * @return mixed
         */
        public function getDataCreacio()
        {
            return $this->dataCreacio;
        }
        
        /**
         * @return mixed
         */
        public function getDataDarrerAcces()
        {
            return $this->dataDarrerAcces;
        }
        
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
        
        /**
         * @param mixed $email
         */
        public function setEmail($email) {
            include "config.php";
            
            if ($email == "") {
                $this->errorsDetectats["email"] = "l'email és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esEmail($email)) {
                    $this->errorsDetectats["email"] = "l'email no té un format adient.";
                } else {
                    $this->email = $email;
                }
            }
        }
        
        /**
         * @param mixed $password
         */
        public function setPassword($sPassword, $cPassword)    {
            if (($sPassword == "") || ($cPassword == "")) {
                $this->errorsDetectats["pass"] = "El password és una dada obligatòria, si us plau indica-la.";
            } else {
                if ($sPassword != $cPassword) {
                    $this->errorsDetectats["cpass"] = "La repetició del password no correspon amb el password entrat.";
                } else {
                    $this->password = $sPassword;
                }
            }
        }
        
        /**
         * @param mixed $tipusIdent
         */
        public function setTipusIdent($sTipus)    {
            if (! $this->esTipus($sTipus)) {
                $this->errorsDetectats["tipus"] = "Hi ha algun error amb el tipus";
            } else {
                $this->tipusIdent = $sTipus;
            }
        }
        
        /**
         * @param mixed $numeroIdent
         */
        public function setNumeroIdent($sDni)    {
            if ($sDni == "") {
                $this->errorsDetectats["dni"] = "El dni és una dada obligatòria, si us plau indica-la.";
            } else {
                if (($this->tipusIdent != "pas") && (! $this->validarNif($sDni))) {
                    $this->errorsDetectats["dni"] = "El dni no té un format correcte.";
                } else {
                    $this->numeroIdent = $sDni;
                }
            }
        }
        
        /**
         * @param mixed $nom
         */
        public function setNom($sNom)    {
            if ($sNom == "") {
                $this->errorsDetectats["nom"] = "El nom és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esNom($sNom)) {
                    $this->errorsDetectats["nom"] = "El nom no té un format correcte.";
                } else {
                    $this->nom = $sNom;
                }
            }
        }
        
        /**
         * @param mixed $cognoms
         */
        public function setCognoms($sCognoms)     {
            if ($sCognoms == "") {
                $this->errorsDetectats["cognoms"] = "El nom és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esNom($sCognoms)) {
                    $this->errorsDetectats["cognoms"] = "Els cognoms no tenen un format correcte.";
                } else {
                    $this->cognoms = $sCognoms;
                }
            }
        }
        
        /**
         * @param mixed $sexe
         */
        public function setSexe($sSexe)    {
            if (! $this->esSexe($sSexe)) {
                $this->errorsDetectats["sexe"] = "Hi ha hagut algun problema amb la seleccio de sexe.";
            }else {
                $this->sexe = $sSexe;
            }
        }
        
        /**
         * @param mixed $datanaixement
         */
        public function setDatanaixement($dNaixement)    {
            if ($dNaixement == "") {
                $this->errorsDetectats["dNaixement"] = "La data de naixement és una dada obligatòria, si us plau indica-la.";
            } else {
                $this->datanaixement = $dNaixement;
            }
        }
        
        /**
         * @param mixed $adreca
         */
        public function setAdreca($adreca)    {
            $this->adreca = $adreca;
        }
        
        /**
         * @param mixed $codiPostal
         */
        public function setCodiPostal($sCP)    {
            if (($sCP != "") && (! $this->esCodiPostal($sCP))) {
                $this->errorsDetectats["cp"] = "Els codi postal no correspon a cap població.";
            } else {
                $this->codiPostal = $sCP;
            }
        }
        
        /**
         * @param mixed $poblacio
         */
        public function setPoblacio($poblacio)    {
            $this->poblacio = $poblacio;
        }
        
        /**
         * @param mixed $provincia
         */
        public function setProvincia($sProvincia)    {
            if (($sProvincia != "") && (! $this->esProvincia($sProvincia))) {
                $this->errorsDetectats["provincia"] = "La provincia no és una de les espanyoles.";
            } else {
                $this->provincia = $sProvincia;
            }
        }
        
        /**
         * @param mixed $telefon
         */
        public function setTelefon($sTelefon)     {
            if (($sTelefon != "") && (! $this->esTelefon($sTelefon))) {
                $this->errorsDetectats["telefon"] = "El format del telèfon no és correcte.";
            } else {
                $this->telefon = $sTelefon;
            }
        }
        
        /**
         * @param mixed $imatge
         */
        public function setImatge($imatge)     {
            include "config.php";
            if ($_FILES['imatge']['error'] == 0) { // Si hi ha foto ....
                $imatge = $_FILES['imatge']['tmp_name']; // carreguem el nom temporal del fitxer
                $nomOriginal = $_FILES['imatge']['name']; // carreguem el nom original
                $sImatge = $nomOriginal;
                $tamany = $_FILES['imatge']['size']; // carreguem el tamany del fitxer en bytes
                $error = $_FILES['imatge']['error']; // carreguem el tamany del fitxer en bytes
                $tipus = $_FILES['imatge']['type']; // carreguem el tipus mime del fitxer en bytes
                
                if ($error === 0) {
                    $aNom = explode('.', $nomOriginal); // Busquem l'extensió del fitxer
                    $aNomLong = count($aNom); // ens diu quants elements té l'array
                    $sExtensio = strtolower($aNom[-- $aNomLong]);
                    
                    // Verifiquem si hi ha errors en la pujada del fitxer:
                    if (in_array($sExtensio, $formatsImatgesPermesos)) { // format incorrecte per extensió
                        if (in_array($tipus, $mimesImatgesPermesos)) { // format incorrecte per mime
                            if ($tamany > 2097152) { // tamany massa gran
                                $this->errorsDetectats["imatge"] = "Error2013 - Tamany excessiu del fitxer";
                            } else {
                                $nomNou = microtime(true) . '_' . $nomOriginal; // Afegim l'hora per fer un fitxer únic
                                $rutaNova = $directoriDePujades . $nomNou; // Afegim el path al nom del fitxer
                                $result = move_uploaded_file($imatge, $rutaNova); // Movem el fitxer a la carpeta
                                
                                if ($result) {
                                    $this->imatge = $rutaNova;
                                } else {
                                    $this->errorsDetectats["imatge"] = "Error2014 - Problemes al moure el fitxer definitiu";
                                }
                            }
                        } else {
                            $this->errorsDetectats["imatege"] = "Error2012 - El format intern del fitxer no està permés";
                        }
                    } else {
                        $this->errorsDetectats["imatge"] = "Error2011 - Tipus de fitxer amb extensió no permesa";
                    }
                } else {
                    // Si s'ha intentat pujar un fitxer però ha donat error.
                    // Si no s'ha pujat.... tot ok
                    if ($_FILES['imatge']['error'] != 4) {
                        $this->errorsDetectats["imatge"] = "Error2010 - No ha pujat el fitxer. Error: " . $error;
                    }
                }
            }
        }
        
        /**
         * @param mixed $status
         */
        public function setStatus($status) {
            $this->status = $status;
        }
        
        /**
         * @param mixed $navegador
         */
        public function setNavegador() {
            $this->navegador = substr($_SERVER["HTTP_USER_AGENT"], 0, strpos($_SERVER["HTTP_USER_AGENT"], "("));;
        }
        
        /**
         * @param mixed $plataforma
         */
        public function setPlataforma()    {
            $iniciCadena = strpos($_SERVER["HTTP_USER_AGENT"], "(") + 1;
            $finalCadena = strpos($_SERVER["HTTP_USER_AGENT"], ")") - 1;
            $this->plataforma = substr($_SERVER["HTTP_USER_AGENT"], $iniciCadena, $finalCadena - $iniciCadena);;
        }
        
        function esTipus($dadaAVerificar) {
            $tipusValids = array ("NIF", "NIE", "PAS");
            if (in_array($dadaAVerificar, $tipusValids) ) {
                $esCorrecte = true;
            } else {
                $esCorrecte = false;
            }
            return $esCorrecte;
        }
        function esSexe($dadaAVerificar) {
            $tipusValids = array ("H", "D");
            if (in_array($dadaAVerificar, $tipusValids) ) {
                $esCorrecte = true;
            } else {
                $esCorrecte = false;
            }
            return $esCorrecte;
        }
        
        function validarNif ($nif) {
            $nif = strtoupper($nif);
            $lletresValides = "TRWAGMYFPDXBNJZSQVHLCKE";
            $nifCorrecte = FALSE;
            
            if ((strlen($nif)== 9) && (strpos("XYZ0123456789",$nif[0])!==false)) {
                $numero = substr($nif, 0, 8);
                $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);
                
                if(substr($nif, -1, 1) == substr($lletresValides, $numero % 23, 1)) {
                    $nifCorrecte = TRUE;
                }
            }
            return $nifCorrecte;
        }
        
        function esEmail($emailAVerificar) {
            if (filter_var($emailAVerificar,FILTER_VALIDATE_EMAIL)) {
                $esEmail = true;
            } else {
                $esEmail = false;
            }
            return $esEmail;
        }
        
        function esNom($nomAValidar) {
            if (preg_match("/^[a-z ']*$/",$nomAValidar)) {
                $esNom = true;
            } else {
                $esNom = false;
            }
            return $esNom;
        }
        
        function esCodiPostal($codiPostalAVerificar) {
            if ((strlen($codiPostalAVerificar) == 5) && (is_numeric($codiPostalAVerificar))) {
                $esCP = true;
            } else {
                $esCP = false;
            }
            return $esCP;
        }
        
        function esProvincia($provinciaAVerificar) {
            $provincias = array('alava', 'arava','albacete','alacant','alicante','almería','asturias','avila','badajoz','barcelona','burgos','cáceres',
                'cádiz','cantabria','castelló','castellón','ciudad real','córdoba','la coruña','cuenca','girona','gerona','granada','guadalajara',
                'guipuzkoa','guipúzcoa','huelva','huesca','illes balears','islas baleares','jaén','león','lleida','lérida','lugo','madrid','málaga','murcia','navarra',
                'orense','palencia','las palmas','pontevedra','la rioja','salamanca','segovia','sevilla','soria','tarragona',
                'santa cruz de tenerife','teruel','toledo','valència','valencia','valladolid','bizkaia','vizcaya','zamora','zaragoza');
            if (in_array($provinciaAVerificar,$provincias)) {
                $esUnProvincia = true;
            } else {
                $esUnProvincia = false;
            }
            return $esUnProvincia;
        }
        
        function esTelefon($telefonAVerificar) {
            if ((strlen($telefonAVerificar)== 9) && (is_numeric($telefonAVerificar)) ) {
                $esTelefon = true;
            } else {
                $esTelefon = false;
            }
            return $esTelefon;
        }
    }
