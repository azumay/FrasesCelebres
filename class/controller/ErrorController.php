<?php
class ErrorController {
    private $thrownException; 
    
    public function __construct($thrownEx) {
        $this->thrownException=$thrownEx;
    }
    
    public function show() {
        include_once "php/functions.php";
        include_once "config.php";
        
        $vError = new ErrorView($this->thrownException);
        $vError->show();
        
        /*
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        $titol = "S'ha produit un error";
        $missatge = $this->thrownException->getMessage();
        include "templates/tpl_error.php";
        
        include "templates/tpl_footer.php";
        */
    }
    
    
}

