<?php
class AutorController extends Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function show() {
        //include_once "php/functions.php";
        //include_once "config.php";

        $showXML = new AutorModel();
        
      
        $frases = new BaseDatos();
        $frases ->createDB(); 
        $frases ->insertAutor($showXML ->loadingData());

        
        
        $pageFrases = new AutorView();
        $pageFrases -> show();


        
    }
    
    
}

