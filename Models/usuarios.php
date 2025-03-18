<?php

// Chamamos ao arquivo de conexión coa db
include_once('connect.php');

// Función para rexistrar aos novos usuarios
function rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

    // Facemos unha variable para insertar os datos onde ainda non introducir variables para coidarnos de insercción sql
    $insert_novo_rexistro = $conn ->prepare("INSERT INTO novo_rexistro (usuario,contrasinal,nome,direccion,telefono,nifdni)
    VALUES (?,?,?,?,?,?)");

    // Engadimos os datos a insertar na variable onde especificamos que tipo de valor é cada un (ssssis)
    $insert_novo_rexistro->bind_param("ssssis",$usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni);

    // Agora executamos o insert e comprobamos o estado
    if ($insert_novo_rexistro->execute()){
        // Se foi exitoso cerraremos a conexión coa db
        $insert_novo_rexistro->close();
        DesconexionDB($conn);
        return true;
    } else {
        // Se houbo un problema diremosllo ao usuario e cerraremos a conexión coa db
        echo "Erro ao rexistrar: ".$insert_novo_rexistro->error; // Utilizamos $variable->error para obter detalles sobre o erro dunha consulta preparada 
        $insert_novo_rexistro->close();
        DesconexionDB($conn);
        return false;
    }
}
?>
