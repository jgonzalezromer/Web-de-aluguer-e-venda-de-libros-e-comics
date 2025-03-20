<?php
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

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
    $usuario = $_SESSION['usuario'];


    aluguer_libroscomics($titulo,$cantidade,$usuario);
}
?>