<?php
// Iniciamos a sesión para manter os datos do usuario entre páxinas
session_start();

// Incluímos o modelo
include_once("../Model/usuarios.php");

// Verificamos se o usuario iniciou sesión
if (!isset($_SESSION['usuario'])) {
    die("Erro: Usuario non autenticado");
}

// Obtemos o nome de usuario da sesión
$usuario = $_SESSION['usuario'];
// Chamamos á función que obtén os datos do usuario
$datosUsuario = obtenerUsuario($usuario);

// Verificamos se os datos foron obtidos
if (!$datosUsuario) {
    die("Erro ao cargar os datos do usuario.");
}

// Extraemos las variables antes de cargar la vista
$nome = $datosUsuario['nome'];
$direccion = $datosUsuario['direccion'];
$telefono = $datosUsuario['telefono'];
$nifdni = $datosUsuario['nifdni'];

// Incluímos a vista correspondente para mostrar os datos do usuario
include_once("../View/conf_usuario.php");
?>