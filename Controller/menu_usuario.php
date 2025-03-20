<?php
include_once("../View/menu_usuario.html");
include_once("../Models/libroscomics.php");
echo "</br></br></br>";
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