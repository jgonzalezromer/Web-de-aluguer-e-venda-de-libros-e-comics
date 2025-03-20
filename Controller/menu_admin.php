<?php
// Iniciamos a sesión para manter a información do usuario en diferentes páxinas
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluímos os arquivos necesarios
include_once("../View/menu_admin.html");
include_once("../Models/libroscomics.php");
include_once("../Models/usuarios.php");

// Comprobamos cal foi a acción solicitada polo administrador a través do formulario
if (isset($_POST['admitir_usuarios'])) {
    admitirUsuarios();
    echo "Usuarios admitidos correctamente.";
} elseif (isset($_POST['engadir_libro_aluguer'])) {
    engadirLibroAluguer($_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
} elseif (isset($_POST['engadir_libro_venda'])) {
    engadirLibroVenda($_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
} elseif (isset($_POST['eliminar_libro_aluguer'])) {
    eliminarLibroAluguer($_POST['titulo']);
} elseif (isset($_POST['eliminar_libro_venda'])) {
    eliminarLibroVenda($_POST['titulo']);
} elseif (isset($_POST['modificar_libro_aluguer'])) {
    modificarLibroAluguer($_POST['id'], $_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
} elseif (isset($_POST['modificar_libro_venda'])) {
    modificarLibroVenda($_POST['id'], $_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
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