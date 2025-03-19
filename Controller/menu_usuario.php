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
}
?>