<?php
// Iniciamos a sesión para manter a información do usuario en diferentes páxinas
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluímos o arquivo do modelo
include_once('../Models/libroscomics.php');

// Comprobamos se se enviou o formulario de devolución
if (isset($_POST['devolver'])) {
    // Gardamos os datos enviados polo formulario
    $titulo = $_POST['titulo'];
    $usuario = $_SESSION['usuario']; // Obtemos o usuario que está autenticado

    // Chamamos á función que rexistrará a devolución na base de datos
    if (rexistrar_devolucion($titulo, $usuario)) {
        echo "Devolución rexistrada con éxito. Pendente de confirmación por un administrador.";
    } else {
        echo "Erro ao rexistrar a devolución.";
    }
}
?>