<?php
// Iniciamos a sesión para manter os datos do usuario autenticado
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Cargamos o contido do arquivo HTML
$contido_html = file_get_contents("../View/aluguer_libroscomics.html");

// Incluímos o modelo
include_once("../Models/libroscomics.php");

// Capturamos a saída da función que mostra os libros
ob_start();
ver_libroscomics_aluguer();
$libroscomics_html = ob_get_clean();
// Substituímos a etiqueta de marcador polo contido
$contido_html = str_replace("<!-- {LIBROS_COMICS} -->",$libroscomics_html,$contido_html);
// Mostramos o contido final da páxina
echo $contido_html;

// Comprobamos se se enviou o formulario para alugar un libro
if (isset($_POST['alugar'])){
    // Recollemos os datos do formulario
    $titulo=$_POST['titulo'];
    $cantidade=$_POST['cantidade'];
    $usuario = $_SESSION['usuario'];

    // Chamamos á función que xestiona o proceso de aluguer
    aluguer_libroscomics($titulo,$cantidade,$usuario);
}
?>