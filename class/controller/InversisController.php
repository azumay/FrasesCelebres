<?php
class InversisController extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        //include_once "php/functions.php";
        
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        $fitxerDeTraduccions = "languages/$lang"."_traduccio.php";
        require_once $fitxerDeTraduccions;
        
        $html_opacityLang[$lang] = "style=\"opacity:1;\"";
        
        $newTable = $this->webScrappingInversis();
        $taula = $this->html_generateTable($newTable);
        $_SESSION["cotis"] = $newTable;
        
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true) {
            //include "templates/tpl_body_cotis.php";
            
            $vInversis = new InversisView();
            $vInversis->show($taula);
        } else {
            //include "templates/tpl_body_login.php";
            $cUser = new UsuarioController();
            $cUser->logIn();
            
        }
        
        $vInversis = new InversisView();
        
    }
    
    
    function isElementSimple($element) {
        $numeroDAparicions = substr_count($element, "<");
        return ($numeroDAparicions <= 2);
    }
    
    function extreuContingut($element, $etiqueta) {
        do {
            if ($this->isElementSimple($element)) {
                $finalEtiquetaApertura = strpos($element, ">", 0);
                $iniciEtiquetaTancament = strpos($element, "<", $finalEtiquetaApertura);
                $longitud = $iniciEtiquetaTancament - $finalEtiquetaApertura - 1;
                return ($longitud < 0) ? "" : trim(substr($element, $finalEtiquetaApertura + 1, $longitud));
            } else {
                
                // Busquem l'etiqueta interna. El sub-element
                $iniciSubElement = strpos($element, "<", 1) + 1;
                $blancFiSubElement = strpos($element, " ", $iniciSubElement);
                $majorFiSubElement = strpos($element, ">", $iniciSubElement);
                $fiSubElement = ($blancFiSubElement != FALSE && $blancFiSubElement < $majorFiSubElement) ? $blancFiSubElement : $majorFiSubElement;
                
                $longitudEtiqueta = $fiSubElement - $iniciSubElement;
                $etiqueta = substr($element, $iniciSubElement, $longitudEtiqueta);
                
                $iniciElementIntern = strpos($element, "<$etiqueta", 0);
                $fiElementIntern = strpos($element, "</$etiqueta>", $iniciElementIntern);
                if ($fiElementIntern == FALSE) {
                    $fiElementIntern = strpos($element, ">", $iniciElementIntern) + 1;
                }
                $elementIntern = substr($element, $iniciElementIntern, $fiElementIntern - $iniciElementIntern + strlen($etiqueta));
                $resultat = $this->extreuContingut($elementIntern, $etiqueta);
                
                if (empty($resultat)) {
                    // elimino el subelement
                    $element = str_replace($elementIntern, "", $element);
                }
            }
        } while (empty($resultat));
        return $resultat;
    }
    
    function extreureFila($element) {
        // Camp nom
        $inici = strpos($element, '<td ', 0);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["nom"] = $text;
        
        // ticker
        $inici = strpos($element, '<td', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["ticker"] = $text;
        
        // mercat
        $inici = strpos($element, '<td', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["mercat"] = $text;
        
        // no tracto
        $inici = strpos($element, '<td', $fi);
        $fi = strpos($element, '</td>', $inici);
        
        // Ultima cotitzacio
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["ultima_coti"] = $text;
        
        // Divisa
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["divisa"] = $text;
        
        // Variació
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["variacio"] = $text;
        
        // Variació percentual
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["variacio_percent"] = $text;
        
        // Volum
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["volum"] = $text;
        
        // Minim
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["mínim"] = $text;
        
        // Màxim
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["màxim"] = $text;
        
        // Data
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = $this->extreuContingut($td, "td");
        $resultat["data"] = $text;
        
        // Hora
        $inici = strpos($element, '<td ', $fi);
        $fi = strpos($element, '</td>', $inici) + 5;
        $td = trim(substr($element, $inici, $fi - $inici));
        $text = trim($this->extreuContingut($td, "td"));
        $resultat["hora"] = substr($text, 0, 5);
        
        return $resultat;
    }
    
    function webScrappingInversis(){
        $ruta = "https://www.inversis.com/inversiones/productos/cotizaciones-nacionales&pathMenu=3_1_0_0&esLH=N";
        $contingut = file_get_contents($ruta);
        $pos = 0;
        
        while (($posIni = strpos($contingut, "<tr id=\"tr_", $pos)) !== FALSE) {
            $posFi = strpos($contingut, "</tr>", $posIni);
            $contingutDeTR = substr($contingut, $posIni, $posFi - $posIni);
            
            $taulaResultat = $this->extreureFila($contingutDeTR);
            $ibex[] = $taulaResultat;
            $pos = $posFi;
        }
        
        return $ibex;
    }
    
    
    
    function html_generateTable($aParametre) {
        $capcelera = "<tr>\n";
        $cos = "<tbody>\n";
        
        foreach ($aParametre as $key => $value) {
            $cos .= "<tr>";
            foreach ($value as $clau => $valor) {
                if (!isset($resultat)) {
                    $capcelera .= "<th>".ucwords($clau)."</th>";
                }
                if ($clau == "ultima_coti") {
                    if (isset($_SESSION["cotis"])) {
                        if (floatval(str_replace(",",".",$valor)) > floatval(str_replace(",",".",$_SESSION["cotis"][$key]["ultima_coti"]))) {
                            $cos .= "<td class=\"bgGreen\">$valor</td>";
                        } elseif (floatval(str_replace(",",".",$valor)) < floatval(str_replace(",",".",$_SESSION["cotis"][$key]["ultima_coti"]))) {
                            $cos .= "<td class=\"bgRed\">$valor</td>";
                        } else {
                            $cos .= "<td>$valor</td>";
                        }
                    } else {
                        $cos .= "<td>$valor</td>";
                    }
                } elseif ($clau == "variacio" || $clau == "variacio_percent") {
                    if (floatval(str_replace(",",".",$valor))<0) {
                        $cos .= "<td class=\"red\">$valor</td>";
                    } elseif (floatval(str_replace(",",".",$valor))>0){
                        $cos .= "<td class=\"green\">$valor</td>";
                    } else {
                        $cos .= "<td>$valor</td>";
                    }
                } else {
                    $cos .= "<td>$valor</td>";
                }
            }
            $cos .= "</tr>\n";
            $resultat = "<table>$capcelera</tr>\n";
        }
        $cos .= "</tr>\n</tbody>";
        $resultat .= "$cos</table>";
        
        return $resultat;
    }
    
}

