<?php
class FrasesView extends View
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

        $mostrarFrases = new FraseModel();
        $frasesShow = $mostrarFrases->mostrar(2);

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_header_menu.php";
        echo "<table style='margin:50px auto; width: 80%'>";
        echo " <caption><h1 class='titulo-tabla'>Frases</h1></caption>";
        echo " <thead>
                    <tr class='cabecera-table' >
                        <th>Id</th>
                        <th>Texto</th>
                        <th>Autor_id</th>
                        <th>Tema_id</th>
                        <th></th>
                        <th></th>
                    </tr>
              </thead>";

        foreach ($frasesShow as $row) {

            echo "<tr>";
            echo "<th><div style='margin:auto;width:100px;'>" . ($row->getId()) . "</div></th>";
            echo "<th><div style='text-align:left;width:800px; padding: 15px;'>" . ($row->getTexto()) . "</div></th>";
            echo "<th><div >" . ($row->getAutor()) . "</div></th>";
            echo "<th><div>" . ($row->getTema()) . "</div></th>";
            echo "<th><div style='margin: auto; width: 100px;'><button style='width:100px;' type='submit'  " . $row->getId() . "'>Editar</button></th></div>";
            echo "<th><div style='margin: auto; width: 100px;'><button style='width:100px;' class='btn-borrar' type='submit' " . $row->getId() . "' >Borrar</button></th></div>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
        include "templates/tpl_footer.php";
    }


}
