<?php
class AutorController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function eliminar($id) {
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        $resetId= implode($id);

        $borrar = new AutorModel ();

        $borrar ->eliminar($resetId);
    }    
        
    
    public function show() {
   
        $pageFrases = new AutorView();
        $pageFrases -> show();


        
    }
    
    
}

