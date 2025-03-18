<?php
    // Chamamos aos arquivos de Models e View
    include_once('../Models/usuarios.php');
    include_once('../View/rexistro.html');

    // Agora comprobamos se o formulario foi enviado
    if (isset($_POST['rexistro'])){
        // Se foi enviado gardaremos as respostas do formulario
        $usuario = $_POST['usuario'];
        $contrasinal = $_POST['contrasinal'];
        $repite_contrasinal = $_POST['repite_contrasinal'];
        $nome = $_POST['nome'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $nifdni = $_POST['nifdni'];
    
        // Comprobamos que puxose a mesma contrasinal
        if ($contrasinal !== $repite_contrasinal){
            echo "As contrasinais non coinciden";
        } else {
            // Gardamos
            $rexistro=rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni);

            if ($rexistro) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Erro ao rexistrar.";
            }
        }
    }
?>