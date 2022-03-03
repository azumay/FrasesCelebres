<?php
class ErrorView extends View{
    private $_exception;
    
    public function __construct($param=null) {
        parent::__construct();
        $this->_exception=$param;
    }
    
    public function show() {
        require_once $this->fitxerDeTraduccions();
        $html_opacityLang[$this->getIdioma()]="style=\"opacity:1;\"";
        
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
            
        $titol = "Procès finalitzat amb errors";
        $missatge = "Avisa a l'administrador: <br> {$this->_exception->getMessage()}";
        include "templates/tpl_error.php";
        
        include "templates/tpl_footer.php";
    }
    
    public function showMessage($titol, $missatge) {
        require_once $this->fitxerDeTraduccions();
        $html_opacityLang[$this->getIdioma()]="style=\"opacity:1;\"";
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        include "templates/tpl_error.php";
        
        include "templates/tpl_footer.php";
    }
    
    public function showOk($titol, $missatge) {
        require_once $this->fitxerDeTraduccions();
        $html_opacityLang[$this->getIdioma()]="style=\"opacity:1;\"";
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        
        include "templates/tpl_ok.php";
        
        include "templates/tpl_footer.php";
    }
}