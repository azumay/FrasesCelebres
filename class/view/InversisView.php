<?php
class InversisView extends View {
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($taula) {
//        include_once "php/functions.php";
//        include_once "config.php";
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        include "templates/tpl_body_cotis.php";
        
        include "templates/tpl_footer.php";
    }
}

