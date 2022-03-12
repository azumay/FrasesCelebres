<?php
class AutorView extends View
{
    private $missatge;

    public function __construct($msg = null)
    {
        parent::__construct();
        if (isset($msg)) {
            $this->missatge = $msg;
        } else {
            $this->missatge = new Missatge();
        }
    }

    public function show()
    {
        
        //include_once "php/functions.php";
        //include_once "config.php";

        $mostrarAutores = new AutorModel();
        $autoresShow = $mostrarAutores->mostrar(2);

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";

        echo "<form action='' method='GET'>";
        echo "<table style='margin:50px auto; width: 80%'>";
        echo " <caption><h1 class='titulo-tabla'>Autor</h1></caption>";

        echo " <thead>
                    <tr class='cabecera-table' >
                        <th>Id</th>
                        <th>Autor</th>
                        <th>Descripción</th>
                        <th></th>
                        <th></th>
                    </tr>
              </thead>";

        foreach ($autoresShow as $row) {
            $idToDelete= $row->getId();
            echo "<tr>";
            echo "<th><div style='margin: auto;width:100px; padding: 15px'>" . utf8_encode($row->getId()) . "</div></th>";
            echo "<th><div style='text-align:left;width:300px; padding: 15px'>" . utf8_encode($row->getNombre()) . "</div></th>";
            echo "<th><div style='text-align:left; width:500px; padding: 15px'>" . utf8_encode($row->getDescripcion()) . "</div></th>";
            echo "<th><div style='margin: auto; width: 100px;'><button style='width:100px;' type='submit'  " . $row->getId() . "'>Editar</button></th></div>";
            echo "<th><div style='margin: auto; width: 100px;'><button style='width:100px;' class='btn-borrar' type='submit name='url'type='submit' name='url' value='FraseController/eliminar/". $idToDelete . "' >Borrar</button></th></div>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
      
       
        include "templates/tpl_footer.php";
    }


}
