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
            echo "<p style='color: red;'>As contrasinais non coinciden</p>";
        } else {
            // Gardamos o rexistro nunha variable
            $rexistro=rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni);
            // Agora comprobamos a varibale para saber se foi existosa
            if ($rexistro) {
                // Se foi exitosa rediriximos a páxina inicial
                header("Location: ../index.php");
                // Cortamos o script para que non se execute nada máis
                exit();
            } else {
                echo "Erro ao rexistrar.";
            }
        }
    }
?>