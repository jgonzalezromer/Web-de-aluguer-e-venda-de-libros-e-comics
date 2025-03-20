<?php
session_start();
include_once("../Model/usuarios.php");

if (!isset($_SESSION['usuario'])) {
    die("Erro: Usuario non autenticado");
}

$usuario = $_SESSION['usuario'];
$datosUsuario = obtenerUsuario($usuario);

if (!$datosUsuario) {
    die("Erro ao cargar os datos do usuario.");
}

// Extraemos las variables antes de cargar la vista
$nome = $datosUsuario['nome'];
$direccion = $datosUsuario['direccion'];
$telefono = $datosUsuario['telefono'];
$nifdni = $datosUsuario['nifdni'];

include_once("../View/conf_usuario.php");