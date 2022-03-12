<?php
class TemaView extends View
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

        $mostrarTemas = new TemaModel();
        $temasShow = $mostrarTemas->mostrar(2);

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        echo "<form action='' method='GET'>";
        echo "<table style='margin:50px auto; width: 80%'>";
        echo " <caption><h1 class='titulo-tabla'>Temas</h1></caption>";
        echo " <thead>
                    <tr class='cabecera-table' >
                        <th>Id</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
              </thead>";
         
        foreach ($temasShow as $row) {
           $idToDelete= $row->getId();
           
            echo "<tr>";
            echo "<th><div style='text-align:center;width:100px;'>" . utf8_encode($row->getId()) . "</div></th>";
            echo "<th><div style='width:500px; margin: auto;'>" . utf8_encode($row->getNombre()) . "</div></th>";
            echo "<th style='width: 150px;'><div style='margin: auto; width: 100px;'><button style='width:100px;' type='submit'  " . $row->getId() . "'>Editar</button></th></div>";
            echo "<th style='width: 150px;'>
            <div style='margin: auto; width: 100px;'><button style='width:100px;' class='btn-borrar' type='submit' name='url' value='TemaController/eliminar/".  $idToDelete."' >
                    Borrar</button>
                </th>
            </div>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
        include "templates/tpl_footer.php";
    }


}
