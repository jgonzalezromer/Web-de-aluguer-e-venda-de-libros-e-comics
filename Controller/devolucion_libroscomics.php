<?php
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include_once('../Models/libroscomics.php');

if (isset($_POST['devolver'])) {
    $titulo = $_POST['titulo'];
    $usuario = $_SESSION['usuario'];

    if (rexistrar_devolucion($titulo, $usuario)) {
        echo "Devolución rexistrada con éxito. Pendente de confirmación por un administrador.";
    } else {
        echo "Erro ao rexistrar a devolución.";
    }
}
?>