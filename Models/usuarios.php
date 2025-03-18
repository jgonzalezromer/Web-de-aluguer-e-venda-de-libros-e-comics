<?php
include_once('connect.php');

function rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni){
    $conn=ConexionDB();
    $insert_novo_rexistro = $conn ->prepare("INSERT INTO novo_rexistro (usuario,contrasinal,nome,direccion,telefono,nifdni)
    VALUES (?,?,?,?,?,?)");

    $insert_novo_rexistro->bind_param("ssssis",$usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni);

    if ($insert_novo_rexistro->execute()){
        echo "¡Rexistro exitoso!";
        $insert_novo_rexistro->close();
        DesconexionDB($conn);
        return true;
    } else {
        echo "Erro ao rexistrar: ".$insert_novo_rexistro->error;
        $insert_novo_rexistro->close();
        DesconexionDB($conn);
        return false;
    }
}
?>
