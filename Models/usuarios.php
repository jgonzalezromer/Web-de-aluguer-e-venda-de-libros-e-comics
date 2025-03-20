<?php

// Chamamos ao arquivo de conexión coa db
include_once('connect.php');

// Funcion para admintir usuarios da taboa novo_rexistro
function admitirUsuarios() {
    $conn = ConexionDB();
    // Mover los usuarios registrados de 'novo_rexistro' a 'usuario'
    $stmt = $conn->prepare("INSERT INTO usuario SELECT * FROM novo_rexistro");
    $stmt->execute();
    $stmt = $conn->prepare("DELETE FROM novo_rexistro");
    $stmt->execute();
    $stmt->close();
    DesconexionDB($conn);
}

// Función para obter os datos dun usuario en base ao seu nome de usuario
function obtenerUsuario($usuario) {
    // Conectamos á base de datos
    $conn = ConexionDB();
    // Preparamos a consulta SQL para obter os datos do usuario
    $query = $conn->prepare("SELECT usuario, contrasinal, nome, direccion, telefono, nifdni FROM usuario WHERE usuario = ?");
    // Asignamos os parámetros á consulta
    $query->bind_param("s", $usuario);
    // Executamos a consulta
    $query->execute();
    // Obtemos o resultado da consulta
    $resultado = $query->get_result();
    // Extraemos os datos do usuario como un array asociativo
    $usuarioData = $resultado->fetch_assoc();
    // Pechamos a consulta e a conexión
    $query->close();
    DesconexionDB($conn);
    // Devolvemos os datos do usuario
    return $usuarioData;
}

// Función para actualizar os datos dun usuario na base de datos
function actualizarUsuario($usuario, $contrasinal, $nome, $direccion, $telefono, $nifdni) {
    // Conectamos á base de datos
    $conn = ConexionDB();
    // Preparamos a consulta SQL para actualizar os datos do usuario
    $query = $conn->prepare("UPDATE usuario SET contrasinal = ?, nome = ?, direccion = ?, telefono = ?, nifdni = ? WHERE usuario = ?");
    // Asignamos os parámetros á consulta
    $query->bind_param("ssssss", $contrasinal, $nome, $direccion, $telefono, $nifdni, $usuario);
    // Executamos a consulta e gardamos o resultado
    $resultado = $query->execute();
    // Pechamos a consulta e a conexión
    $query->close();
    DesconexionDB($conn);
    // Devolvemos o resultado da operación
    return $resultado;
}

// Función para rexistrar aos novos usuarios
function rexistro($usuario,$contrasinal,$nome,$direccion,$telefono,$nifdni){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

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

// Función para autenticar a un usuario
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
        // Poderiamos tamen facelo con mais seguridade con if (password_verify($contrasinal,$fila['contrasinal'])) {
        if ($contrasinal == $fila['contrasinal']){
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
    // Devolvemos o estado da autenticación
    return $autenticacion_usuario;
}
?>
