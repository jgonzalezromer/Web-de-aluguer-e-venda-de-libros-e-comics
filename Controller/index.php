<?php
include_once("../View/index.html");
include_once("../Models/usuarios.php");
if (isset($_POST['acesso'])){
    $usuario=isset($_POST['usuario']) ? trim($_POST['usuario']) : null;
    $contrasinal=isset($_POST['contrasinal']) ? trim($_POST['contrasinal']) : null;
}


$autenticacion = autenticacion($usuario,$contrasinal);
switch($autenticacion){
    case 'incorrecto':
        echo "Contraseña incorrecta";
        exit;
    case 'non_existe':
        echo "O usuario non existe";
        header("Location: ./rexistro.php");
        exit;
    case 'usuario':
        header("Location: ./menu_usuario.php");
        exit;
    default:
        header("Location: ./menu_admin.php");
        exit;
}
?>