<?php 
if ($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["lang"])) {
    $lang = $_GET["lang"];
    setcookie("lang",$lang,time()+3600);
} else {
    if (isset($_COOKIE["lang"])) {
        $lang = $_COOKIE["lang"];
    } else {
        $lang = "ca";
    }
}

$fitxerDeTraduccions = "languages/$lang"."_traduccio.php";
require $fitxerDeTraduccions;

$html_opacityLang[$lang]="style=\"opacity:1;\"";
?>


<section class="one">
<?php 
include "templates/tpl_header_logo.php";
include "templates/tpl_header_titol.php";
include "templates/tpl_header_lang.php";
?>
</section>