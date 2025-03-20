<?php
include_once('../Models/libroscomics.php');

if (isset($_POST['devolver'])) {
    $titulo = $_POST['titulo'];
    $usuario = 'usuario';

    if (rexistrar_devolucion($titulo, $usuario)) {
        echo "Devolución rexistrada con éxito. Pendente de confirmación por un administrador.";
    } else {
        echo "Erro ao rexistrar a devolución.";
    }
}
?>