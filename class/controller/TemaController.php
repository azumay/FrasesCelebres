<?php
class TemaController extends Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function show() {
      
        
        $pageFrases = new TemaView();
        $pageFrases -> show();


        
    }
    
    
}

