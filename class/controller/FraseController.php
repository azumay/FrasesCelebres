<?php
class FraseController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function eliminar($id) {
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        $resetId= implode($id);

        
        $borrar = new FraseModel ();

        $borrar ->eliminar($resetId);
        
        
    }
    
    public function show() {
           
        
        $pageFrases = new FrasesView();
        $pageFrases -> show();


        
    }
    
    
}

