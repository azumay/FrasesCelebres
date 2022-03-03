<?php
class FrasesController extends Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function show() {
        //include_once "php/functions.php";
        //include_once "config.php";
      
        //$frases = new BaseDatos();
        //$frases ->createDB(); 

        $showXML = new AutorModel();
        $showXML ->loadingData();
        
        $pageFrases = new FrasesView();
        $pageFrases -> show();


        
    }
    
    
}

