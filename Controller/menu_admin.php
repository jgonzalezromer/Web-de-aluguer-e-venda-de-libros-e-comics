<?php
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include_once("../View/menu_admin.html");
include_once("../Models/libroscomics.php");
include_once("../Models/usuarios.php");

if (isset($_POST['admitir_usuarios'])) {
    include("../View/admitir_usuarios.html");
} elseif (isset($_POST['engadir_libro_aluguer'])) {
    include("../View/engadir_libro_aluguer.html");
} elseif (isset($_POST['engadir_libro_venda'])) {
    include("../View/engadir_libro_venda.html");
} elseif (isset($_POST['eliminar_libro_aluguer'])) {
    include("../View/eliminar_libro_aluguer.html");
} elseif (isset($_POST['eliminar_libro_venda'])) {
    include("../View/eliminar_libro_venda.html");
} elseif (isset($_POST['modificar_libro_aluguer'])) {
    include("../View/modificar_libro_aluguer.html");
} elseif (isset($_POST['modificar_libro_venda'])) {
    include("../View/modificar_libro_venda.html");
} elseif (isset($_POST['informe_aluguer'])) {
    echo "<h3>Informe de libros e cómics para aluguer</h3>";
    ver_libroscomics_aluguer();
} elseif (isset($_POST['informe_venda'])) {
    echo "<h3>Informe de libros e cómics para venda</h3>";
    ver_libroscomics_venda();
} elseif (isset($_POST['pasar_devoltos'])) {
    pasar_libros_devoltos();
    echo "Libros devoltos pasados a aluguer correctamente.";
}
?>