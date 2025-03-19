<?php

// Chamamos ao arquivo de conexión coa db
include_once('connect.php');

function aluguer_libroscomics($titulo,$cantidade){
    $conn=ConexionDB();

    $stmp = $conn ->prepare("UPDATE libro_aluguer SET cantidade=cantidade - ?
    WHERE titulo=?");
    $stmp->bind_param("is",$cantidade,$titulo);
    
    if ($stmp->execute()) {
        $stmp = $conn ->prepare("SELECT * FROM libro_aluguer = ?");
        $stmp -> bind_param("s",$titulo);
        $stmp -> execute();
        $resultado = $stmp -> get_result();
    } else {
        echo "Erro ao actualizar a cantidade";
    }
    $stmp->close();
    DesconexionDB($conn);
}

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