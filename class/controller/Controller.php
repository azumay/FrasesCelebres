<?php
class Controller {

    public function __construct(){
    }


   

    function sanitize ($stringANetejar, $convertirAlowercase=0){
        if (empty($stringANetejar)) {
            $stringANetejar = "";
        } else {
            $stringANetejar = trim($stringANetejar);
            $stringANetejar = htmlspecialchars(stripslashes(trim($stringANetejar, '-')));
            $stringANetejar = strip_tags($stringANetejar);
            // Preserve escaped octets.
            $stringANetejar = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $stringANetejar);
            // Remove percent signs that are not part of an octet.
            $stringANetejar = str_replace('%', '', $stringANetejar);
            // Restore octets.
            $stringANetejar = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $stringANetejar);
            
            switch ($convertirAlowercase) {
                case 1:
                    if (function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                    }
                    break;
                case 2:
                    if (function_exists('mb_strtoupper')) {
                        $stringANetejar = mb_strtoupper($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtoupper($stringANetejar);
                    }
                    break;
                case 3:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                        
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                    }
                    break;
                case 4:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                        $inici=0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici=$pos+1;
                            $stringANetejar[$inici] = mb_strtoupper($stringANetejar[$inici], 'UTF-8');
                        }
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                        $inici=0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici=$pos+1;
                            $stringANetejar[$inici] = strtoupper($stringANetejar[$inici]);
                            
                        }
                    }
                    break;
            }
        }
        return $stringANetejar;
    }
    
 
    
}

