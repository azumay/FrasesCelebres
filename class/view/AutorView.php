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
        echo "<table style='margin:0 auto; width: 80%'>";

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

            echo "<tr>";
            echo "<th><div style='text-align:center;width:300px;'>" . utf8_encode($row->getId()) . "</div></th>";
            echo "<th><div style='text-align:left;width:300px;'>" . utf8_encode($row->getNombre()) . "</div></th>";
            echo "<th><div style='margin-left:200px;text-align:left;margin-right:100px;'>" . utf8_encode($row->getDescripcion()) . "</div></th>";
            echo "<th><button style='float:right;width:100px;' type='submit'  " . $row->getId() . "'>Editar</button></th>";
            echo "<th><button class='btn-borrar' type='submit' " . $row->getId() . "' >Borrar</button></th>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
        include "templates/tpl_footer.php";
    }


}
