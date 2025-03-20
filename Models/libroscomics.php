<?php

// Chamamos ao arquivo de conexión coa db
include_once('connect.php');

// Movemos os libros devoltos á táboa de aluguer e elimina da táboa de devolucións
function pasar_libros_devoltos() {
    $conn = ConexionDB();
    $stmp = $conn->prepare("INSERT INTO libro_aluguer SELECT * FROM libro_devolto");
    $stmp->execute();

    $stmp = $conn->prepare("DELETE FROM libro_devolto");
    $stmp->execute();

    $stmp->close();
    DesconexionDB($conn);
}

// Obtén todos os libros dispoñibles para a venda
function obter_libros_venda() {
    $conn = ConexionDB();
    $stmp = $conn->prepare("SELECT * FROM libro_venda");
    $stmp->execute();
    $resultado = $stmp->get_result();
    $stmp->close();
    DesconexionDB($conn);
    return $resultado;
}

// Reduce en 1 a cantidade dun libro á venda cando se compra
function actualizar_stock_libro($titulo) {
    $conn = ConexionDB();
    $stmp = $conn->prepare("UPDATE libro_venda SET cantidade = cantidade - 1 WHERE titulo = ?");
    $stmp->bind_param("s", $titulo);
    $stmp->execute();
    $stmp->close();
    DesconexionDB($conn);
}

// Obtén os libros alugados por un usuario específico
function obter_libros_usuario($usuario) {
    $conn = ConexionDB();
    $stmp = $conn->prepare("SELECT * FROM libro_alugado WHERE usuario = ?");
    $stmp->bind_param("s", $usuario);
    $stmp->execute();
    $resultado = $stmp->get_result();
    $stmp->close();
    DesconexionDB($conn);
    return $resultado;
}

// Rexistra a devolución dun libro por parte dun usuario
function rexistrar_devolucion($titulo, $usuario) {
    $conn = ConexionDB();
    $stmp = $conn->prepare("INSERT INTO libro_devolto (titulo, usuario, estado) VALUES (?, ?, 'pendente')");
    $stmp->bind_param("ss", $titulo, $usuario);
    $exito = $stmp->execute();
    $stmp->close();
    DesconexionDB($conn);
    return $exito;
}

// Realiza o aluguer dun libro ou cómic
function aluguer_libroscomics($titulo,$cantidade){
    $conn=ConexionDB();

    // Reduce a cantidade dispoñible do libro en aluguer
    $stmp = $conn ->prepare("UPDATE libro_aluguer SET cantidade=cantidade - ?
    WHERE titulo=?");
    $stmp->bind_param("is",$cantidade,$titulo);
    
    if ($stmp->execute()) {
        // Obtemos os datos do libro para rexistrar o aluguer
        $stmp = $conn ->prepare("SELECT * FROM libro_aluguer WHERE titulo= ?");
        $stmp -> bind_param("s",$titulo);
        $stmp -> execute();
        $resultado = $stmp -> get_result()->fetch_assoc();
         // Inserimos o aluguer na táboa correspondente
        $stmp = $conn ->prepare("INSERT INTO libro_alugado(titulo,cantidade,descripcion,editorial,foto,usuario) 
        VALUES (?,?,?,?,?,?)");
        $titulo = $resultado['titulo'];
        $cantidade = $resultado['cantidade'];
        $descripcion = $resultado['descripcion'];
        $editorial = $resultado['editorial'];
        $foto = $resultado['foto'];
        $usuario = 'usuario';
        $stmp->bind_param("sissss",$titulo,$cantidade,$descripcion,$editorial,$foto,$usuario);
        if($stmp->execute()) {
            echo "Aluguer exitoso";
        }
    } else {
        echo "Erro ao alugar";
    }
    $stmp->close();
    DesconexionDB($conn);
}

// Mostra os libros dispoñibles en aluguer
function ver_libroscomics_aluguer(){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

    $stmp = $conn ->prepare("SELECT * FROM libro_aluguer");

    $stmp -> execute();

    $resultado = $stmp -> get_result();

    if ($resultado-> num_rows > 0){
        echo "<table border='1'>";
        echo "<tr>
                <th>Título</th>
                <th>Cantidade</th>
                <th>Descripción</th>
                <th>Editorial</th>
                <th>Foto</th>
            </tr>";
    
            // Mostramos cada fila do resultado
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['titulo']}</td>
                        <td>{$fila['cantidade']}</td>
                        <td>{$fila['descripcion']}</td>
                        <td>{$fila['editorial']}</td>
                        <td>{$fila['foto']}</td>
                      </tr>";
            }
    
            echo "</table>";
    } else {
        echo "<p style='color: red;'>Non se atoparon libros ou cómics en aluguer.</p>";
    }
    // Cerraremos a conexión coa db e devolvemos a autenticacion do usuario
    $stmp->close();
    DesconexionDB($conn);
}

// Mostra os libros dispoñibles á venda
function ver_libroscomics_venda(){

    // Gardamos a conexión coa base de datos nunha variable
    $conn=ConexionDB();

    $stmp = $conn ->prepare("SELECT * FROM libro_venda");

    $stmp -> execute();

    $resultado = $stmp -> get_result();

    if ($resultado-> num_rows > 0){
        echo "<table border='1'>";
        echo "<tr>
                <th>Título</th>
                <th>Cantidade</th>
                <th>Descripción</th>
                <th>Editorial</th>
                <th>Foto</th>
                </tr>";
    
        // Mostramos cada fila do resultado
        while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                    <td>{$fila['titulo']}</td>
                    <td>{$fila['cantidade']}</td>
                    <td>{$fila['descripcion']}</td>
                    <td>{$fila['editorial']}</td>
                    <td>{$fila['foto']}</td>
                    </tr>";
        }
    
        echo "</table>";
    } else {
        echo "<p style='color: red;'>Non se atoparon libros ou cómics en aluguer.</p>";
    }
    // Cerraremos a conexión coa db e devolvemos a autenticacion do usuario
    $stmp->close();
    DesconexionDB($conn);
}
?>