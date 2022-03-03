<?php
class FrasesView extends View {
    private $missatge;

    public function __construct($msg=null) {
        parent::__construct();
        if (isset($msg)) {
            $this->missatge=$msg;
        }else{
            $this->missatge= new Missatge();
        }
    }
    
    public function show() {
       //include_once "php/functions.php";
    //include_once "config.php";
    
       include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
       include "templates/tpl_body_frases.php";

       include "templates/tpl_footer.php";
        
    }
}