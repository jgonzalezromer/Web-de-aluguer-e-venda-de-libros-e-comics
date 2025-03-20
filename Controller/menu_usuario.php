<?php
// Iniciamos a sesión para manter a información do usuario en diferentes páxinas
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluimos os arquivos necesarios
include_once("../View/menu_usuario.html");
include_once("../Models/libroscomics.php");

echo "</br></br></br>";

// Comprobamos cal foi a acción solicitada polo usuario a través do formulario
// Cos dous primeiros botons mostraranos unha taboa con libros
// Cos seguintes redirixiremos a outras páxinas
if(isset($_POST['ver_libroscomics_aluguer'])){
    echo "<h3>Libros e cómics en aluguer</h3>";
    ver_libroscomics_aluguer();
} elseif(isset($_POST['ver_libroscomics_venda'])){
    echo "<h3>Libros e cómics en venda</h3>";
    ver_libroscomics_venda();
} elseif (isset($_POST['conf_usuario'])){
    header("Location: ./conf_usuario.php");
    exit;
} elseif (isset($_POST['aluguer_libroscomics'])){
    header("Location: ./aluguer_libroscomics.php");
    exit;
} elseif (isset($_POST['devolucion_libroscomics'])){
    header("Location: ./devolucion_libroscomics.php");
    exit;
} elseif (isset($_POST['compra_libroscomics'])){
    header("Location: ./compra_libroscomics.php");
    exit;
} 
?>