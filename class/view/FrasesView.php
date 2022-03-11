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

    $mostrarAutores = new AutorModel();
    $mostrarAutores ->mostrar();
    
       include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        echo "<table style='margin:0 auto;'>";

    echo "<tr>";
    echo "<th><div style='text-align:left;width:300px;'></div></th>";
    echo "<th><div style='margin-left:200px;text-align:left;margin-right:100px;'></div></th>";
    echo "<th><button style='float:right;width:100px;' type='submit' name='url' value='Autors/actualizar/'>Edita</button></th>";
    echo "<th><button style='float:right;width:100px;' type='submit' name='url' value='Autors/eliminar/' >Esborra</button></th>";
    echo "</tr>";

    echo "</table>";
echo "</form>";
include "templates/tpl_footer.php";
}


       //include "templates/tpl_body_frases.php";

       
        
    }
