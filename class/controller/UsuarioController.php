<?php
class UsuarioController extends Controller {
    private $user;

    public function __construct() {
        parent::__construct();
    }
    
    public function logIn() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $vUser=new UsuarioView();
            $vUser->login();
        } else {
            $errorsDetectats=$this->validaDadesLogIn();
            if (isset($errorsDetectats)) {
                $vUser=new UsuarioView($this->user);
                $vUser->login($errorsDetectats);
            } else {
                $mUsuario = new UsuarioModelo();
                if (($result = $mUsuario->getByEmail($this->user)) instanceof Usuario) {
                    // INICIA LA SESSIÓ
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$result->getNom() . " " . $result->getCognoms();
                    $_SESSION['email']=$result->getEmail();
                    $_SESSION['img']=$result->getImatge();
                    header("Location: index.php");
                    exit;
                } else {                
                    $vUser=new UsuarioView($this->user);
                    $vUser->logIn($result);
                }
            }
        }
    }
    
    public function validaDadesLogIn() {
        $sEmail = $this->sanitize($_POST["nom"], 1);
        $sPassword = $this->sanitize($_POST["contrasenya"], 0);
        
        $this->user=new Usuario();
        $this->user->setEmail($sEmail);
        $this->user->setPassword($sPassword, $sPassword);
        
        return $this->user->errorsDetectats;
    }
    
    public function logout() {
        $_SESSION['loggedin']=false;
        unset ($_SESSION['username']);
        unset ($_SESSION['email']);
        unset ($_SESSION['img']);
        header("Location: index.php");
        exit;
    }
    
    
    public function confirmacio($param) {
        if (!isset($param)) {
            throw new Exception("Falten dades per la confirmació");
        }
        $this->user=new Usuario();
        $this->user->setId($this->sanitize($param[0], 0));        
        
        $mUser = new UsuarioModelo();
        $errorsDetectats=$mUser->confirma($this->user);
        
        $vError=new ErrorView();
        if (isset($errorsDetectats)) {
            $vError->showMessage("Procès finalitzat amb errors", "El procès de verificació ha produït un error: <br> {$errorsDetectats["baseDades"]}");
        } else {
            $vError->showOk("Procès finalitzat correctament","El procès de registre ha finacilitzat amb éxit, el mail està validat.<br>Ara ja podràs accedir a la noastra àrea privada.<br><br>Moltes gràcies<br>");
        }
    }
    
    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $vUser=new UsuarioView();
            $vUser->register();
        } else {
            $errorsDetectats=$this->validaDadesRegistre();
            if (isset($errorsDetectats)) {
                $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
                $vUser=new UsuarioView($this->user);
                $vUser->register($errorsDetectats);
            } else {
                    $sNom=$this->user->getNom();
                    $sCognoms=$this->user->getCognoms();
                    $idDelRegistreInsertat=$this->user->getId();
                    
                    $titol = "Procès finalitzat correctament";
                    $missatge .= "Benvolgut/da $sNom $sCognoms<br>
    Ens complau donar-te la benvinguda a la nova aplicació mòbil de residents des de la qual podràs realitzar el pagament mitjançant un telèfon smartphone quan estacionis el teu vehicle a la teva zona de resident de l’AREA de Barcelona sense la necessitat d’anar al parquímetre.<br>
    Per procedir a l’activació del compte has de prémer el següent <a href='?url=UsuarioController/confirmacio/$idDelRegistreInsertat'>enllaç</a>.<br>
    Recorda que pots obtenir ajuda i tota la informació sobre el funcionament de l’aplicació mòbil ONaparcar Residents accedint a la secció preguntes freqüents i que en cas d’ incidència ens ho pots notificar mitjançant el formulari de suport tècnic.<br>
    <br>
    Atentament, ";
                    $vError=new ErrorView();
                    $vError->showOk($titol,$missatge);
            }
        }
    }
    
    public function validaDadesRegistre() {
        $this->user = new Usuario();
        $this->user->setEmail($this->sanitize($_POST["email"], 1));
        $this->user->setPassword($this->sanitize($_POST["pass"], 0), $this->sanitize($_POST["cpass"], 0));
        
        $this->user->setTipusIdent($this->sanitize($_POST["tipus"], 2));
        $this->user->setNumeroIdent($this->sanitize($_POST["dni"], 2));
        $this->user->setNom($this->sanitize($_POST["nom"], 1));
        $this->user->setCognoms($this->sanitize($_POST["cognoms"], 1));
        $this->user->setSexe($this->sanitize($_POST["sexe"], 2));
        $this->user->setDatanaixement($this->sanitize($_POST["naixement"], 0));
        
        $this->user->setAdreca($this->sanitize($_POST["adreca"], 1));
        $this->user->setCodiPostal($this->sanitize($_POST["cp"], 0));
        $this->user->setPoblacio($this->sanitize($_POST["poblacio"], 1));
        $this->user->setProvincia($this->sanitize($_POST["provincia"], 1));
        $this->user->setTelefon($this->sanitize($_POST["telefon"], 0));
        
        $iniciCadena = strpos($_SERVER["HTTP_USER_AGENT"], "(") + 1;
        $finalCadena = strpos($_SERVER["HTTP_USER_AGENT"], ")") - 1;
        
        $this->user->setNavegador(substr($_SERVER["HTTP_USER_AGENT"], 0, strpos($_SERVER["HTTP_USER_AGENT"], "(")));
        $this->user->setPlataforma(substr($_SERVER["HTTP_USER_AGENT"], $iniciCadena, $finalCadena - $iniciCadena)  );
        
        if (! isset($this->user->errorsDetectats)) {
            $this->user->setImatge($this->sanitize($_FILES['imatge']['name'],0));
        }
            
        $mUsuari = new UsuarioModelo();
        if (!$mUsuari->isEmailUnic($this->user)) {
            $this->user->errorsDetectats["email"] = "Aquest email ja existeix a la meva base de dades<br>";
        } 
        
        if (!isset($this->user->errorsDetectats)) {
            if (is_array($res = $mUsuari->save($this->user))) {
                $this->user->errorsDetectats[] = $res;
            } else {
                $this->user->setId($res);
            }            
        }
        
        return $this->user->errorsDetectats;
    }

}

