<?php

// Chamamos ao arquivo de conexión coa db
include_once('connect.php');

// Función para rexistrar aos novos usuarios
function rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

    // Facemos o hash do contrasinal
    $hashed_contrasinal = password_hash($contrasinal, PASSWORD_DEFAULT);

    // Facemos unha variable para insertar os datos onde ainda non introducimos variables para coidarnos de insercción sql
    $insert_novo_rexistro = $conn ->prepare("INSERT INTO novo_rexistro (usuario,contrasinal,nome,direccion,telefono,nifdni)
    VALUES (?,?,?,?,?,?)");

    // Engadimos os datos a insertar na variable onde especificamos que tipo de valor é cada un (ssssis)
    $insert_novo_rexistro->bind_param("ssssis",$usuario,$hashed_contrasinal,$nome,$direccion,$telefono,$nifdni);

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
function autenticacion($usuario,$contrasinal){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

    // Inicializamos unha variable que usaremos para saber o estado da autenticacion
    $autenticacion_usuario = 'non_existe';

    // Facemos unha variable para comprobar os datos onde ainda non introducimos variables para coidarnos de insercción sql
    $atopar_usuario = $conn ->prepare("SELECT * FROM usuario
    WHERE usuario = ?");

    // Engadimos os datos necesario para encontrar o usuario
    $atopar_usuario->bind_param("s",$usuario);

    // Agora executamos o insert e comprobamos se existe o usuario
    $atopar_usuario->execute();

    // Gardamos o resultado da busqueda
    $resultado = $atopar_usuario->get_result();

    // Verificamos se existen resultados
    // Supoñemos que o usuario é a primary key (so pode haber un usuario co mesmo nome)
    if ($fila = $resultado->fetch_assoc()){
        // Verificamos se o contrasinal coincide
        if (password_verify($fila['contrasinal'],$contrasinal)) {

            // Se ten o mesmo contrasinal gardamos o a autenticacion do usuario
            // Supoñemos que no tipo de usuario gardamos os datos como 'A' admin, 'U' usuario
            $autenticacion_usuario=$fila['tipo_usuario'] === 'A' ? 'admin' : 'usuario';
        } else {
            $autenticacion_usuario='incorrecto';
        }
    }
    
    // Cerraremos a conexión coa db e devolvemos a autenticacion do usuario
    $atopar_usuario->close();
    DesconexionDB($conn);
    return $autenticacion_usuario;
}
?>
