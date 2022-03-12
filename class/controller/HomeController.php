<?php
class HomeController extends Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function show() {
        //include_once "php/functions.php";
        //include_once "config.php";
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";


    /*Resetear Base de Datos con valores*/

        $showXML = new AutorModel();
      
        $frases = new BaseDatos();
        $frases ->createDB(); 
        $frases ->insertAutor($showXML ->loadingData());

        
        $resultat = $this->generarCodiAleatori();
        include "templates/tpl_body_main.php";
        
        include "templates/tpl_footer.php";
    }
    
    function generarCodiAleatori(){
        $valorsPossibles = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $resultat = "";
        for ($i = 1; $i <= 6; $i ++) {
            $resultat .= $valorsPossibles[rand(0, strlen($valorsPossibles) - 1)];
        }
        return $resultat;
    }
}

