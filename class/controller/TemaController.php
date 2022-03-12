<?php
class TemaController extends Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function eliminar($id) {
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        $resetId= implode($id);

    
        $borrar = new TemaModel ();

        $borrar ->eliminar($resetId);
        
        
    }
    
    public function show() {
      
        
        $pageFrases = new TemaView();
        $pageFrases -> show();


        
    }
    
    
}

