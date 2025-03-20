<?php
// Iniciamos sesión
session_start(); 

// Chamamos aos arquivos necesarios
include_once("./View/index.html");
include_once("./Models/usuarios.php");


// Comprobamos se o usuario clicou en Rexistrarse ou en Acceso
if (isset($_POST['rexistro'])){

    // Reconducimos ao rexistro
    header("Location: ./Controller/rexistro.php");
    exit;
} elseif (isset($_POST['acesso'])){

    // Recollemos os datos que recheou o usuario (o trim serve para quitar espacios e se non se recheou da null a resposta)
    $usuario=isset($_POST['usuario']) ? trim($_POST['usuario']) : null;
    $contrasinal=isset($_POST['contrasinal']) ? trim($_POST['contrasinal']) : null;

    // Usamos a función autenticacion de usuarios.php para autenticar os credenciais
    $autenticacion = autenticacion($usuario,$contrasinal);

    // Dependendo do que devolvese a funcion daremos distintas respostas ao usuario
    switch($autenticacion){
        case 'incorrecto':
            echo "Contraseña incorrecta";
            exit;
        case 'non_existe':
            echo "O usuario non existe";
            header("Location: ./Controller/rexistro.php");
            exit;
        case 'usuario':
            $_SESSION['usuario'] = $usuario; //Gardamos o usuario que iniciou sesión
            header("Location: ./Controller/menu_usuario.php");
            exit;
        default:
            $_SESSION['usuario'] = $usuario; //Gardamos o usuario que iniciou sesión
            header("Location: ./Controller/menu_admin.php");
            exit;
    }
}
?>