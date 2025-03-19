<?php
$contido_html = file_get_contents("../View/aluguer_libroscomics.html");
include_once("../Models/libroscomics.php");
ob_start();
ver_libroscomics_aluguer();
$libroscomics_html = ob_get_clean();

$contido_html = str_replace("<!-- {LIBROS_COMICS} -->",$libroscomics_html,$contido_html);

echo $contido_html;

if (isset($_POST['alugar'])){
    $titulo=$_POST['titulo'];
    $cantidade=$_POST['cantidade'];


    aluguer_libroscomics($titulo,$cantidade);
}
?>