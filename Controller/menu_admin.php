<?php
// Iniciamos a sesión para manter a información do usuario en diferentes páxinas
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluímos os arquivos necesarios
include_once("../View/menu_admin.html");
include_once("../Models/libroscomics.php");
include_once("../Models/usuarios.php");

// Comprobamos cal foi a acción solicitada polo administrador a través do formulario
if (isset($_POST['admitir_usuarios'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='usuario'>Usuario:</label>
                <input type='text' name='usuario' required><br>
                <label for='contrasinal'>Contraseña:</label>
                <input type='password' name='contrasinal' required><br>
                <label for='nome'>Nombre:</label>
                <input type='text' name='nome' required><br>
                <label for='direccion'>Dirección:</label>
                <input type='text' name='direccion' required><br>
                <label for='telefono'>Teléfono:</label>
                <input type='text' name='telefono' required><br>
                <label for='nifdni'>NIF/DNI:</label>
                <input type='text' name='nifdni' required><br>
                <button type='submit' name='confirmar_admitir_usuario'>Aceptar</button>
            </form>";
    
    // Si ya se ha confirmado, se ejecuta la admisión
    if (isset($_POST['confirmar_admitir_usuario'])) {
        admitirUsuarios($_POST['usuario'], $_POST['contrasinal'], $_POST['nome'], $_POST['direccion'], $_POST['telefono'], $_POST['nifdni']);
        echo "Usuario admitido correctamente.";
    }

} elseif (isset($_POST['engadir_libro_aluguer'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='titulo'>Título:</label>
                <input type='text' name='titulo' required><br>
                <label for='cantidade'>Cantidad:</label>
                <input type='number' name='cantidade' required><br>
                <label for='descripcion'>Descripción:</label>
                <input type='text' name='descripcion' required><br>
                <label for='editorial'>Editorial:</label>
                <input type='text' name='editorial' required><br>
                <label for='foto'>Foto (URL):</label>
                <input type='text' name='foto' required><br>
                <button type='submit' name='confirmar_engadir_libro_aluguer'>Añadir Libro</button>
            </form>";

    if (isset($_POST['confirmar_engadir_libro_aluguer'])) {
        engadirLibroAluguer($_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
        echo "Libro para alquiler añadido correctamente.";
    }

} elseif (isset($_POST['engadir_libro_venda'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='titulo'>Título:</label>
                <input type='text' name='titulo' required><br>
                <label for='cantidade'>Cantidad:</label>
                <input type='number' name='cantidade' required><br>
                <label for='descripcion'>Descripción:</label>
                <input type='text' name='descripcion' required><br>
                <label for='editorial'>Editorial:</label>
                <input type='text' name='editorial' required><br>
                <label for='foto'>Foto (URL):</label>
                <input type='text' name='foto' required><br>
                <button type='submit' name='confirmar_engadir_libro_venda'>Añadir Libro</button>
            </form>";

    if (isset($_POST['confirmar_engadir_libro_venda'])) {
        engadirLibroVenda($_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
        echo "Libro para venta añadido correctamente.";
    }

} elseif (isset($_POST['eliminar_libro_aluguer'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='titulo'>Título del libro a eliminar:</label>
                <input type='text' name='titulo' required><br>
                <button type='submit' name='confirmar_eliminar_libro_aluguer'>Eliminar Libro</button>
            </form>";

    if (isset($_POST['confirmar_eliminar_libro_aluguer'])) {
        eliminarLibroAluguer($_POST['titulo']);
        echo "Libro de alquiler eliminado correctamente.";
    }

} elseif (isset($_POST['eliminar_libro_venda'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='titulo'>Título del libro a eliminar:</label>
                <input type='text' name='titulo' required><br>
                <button type='submit' name='confirmar_eliminar_libro_venda'>Eliminar Libro</button>
            </form>";

    if (isset($_POST['confirmar_eliminar_libro_venda'])) {
        eliminarLibroVenda($_POST['titulo']);
        echo "Libro de venta eliminado correctamente.";
    }

} elseif (isset($_POST['modificar_libro_aluguer'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='id'>ID del libro a modificar:</label>
                <input type='text' name='id' required><br>
                <label for='titulo'>Nuevo Título:</label>
                <input type='text' name='titulo' required><br>
                <label for='cantidade'>Nueva Cantidad:</label>
                <input type='number' name='cantidade' required><br>
                <label for='descripcion'>Nueva Descripción:</label>
                <input type='text' name='descripcion' required><br>
                <label for='editorial'>Nueva Editorial:</label>
                <input type='text' name='editorial' required><br>
                <label for='foto'>Nueva Foto (URL):</label>
                <input type='text' name='foto' required><br>
                <button type='submit' name='confirmar_modificar_libro_aluguer'>Modificar Libro</button>
            </form>";

    if (isset($_POST['confirmar_modificar_libro_aluguer'])) {
        modificarLibroAluguer($_POST['id'], $_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
        echo "Libro de alquiler modificado correctamente.";
    }

} elseif (isset($_POST['modificar_libro_venda'])) {
    echo "<br><br>
            <form method='POST'>
                <label for='id'>ID del libro a modificar:</label>
                <input type='text' name='id' required><br>
                <label for='titulo'>Nuevo Título:</label>
                <input type='text' name='titulo' required><br>
                <label for='cantidade'>Nueva Cantidad:</label>
                <input type='number' name='cantidade' required><br>
                <label for='descripcion'>Nueva Descripción:</label>
                <input type='text' name='descripcion' required><br>
                <label for='editorial'>Nueva Editorial:</label>
                <input type='text' name='editorial' required><br>
                <label for='foto'>Nueva Foto (URL):</label>
                <input type='text' name='foto' required><br>
                <button type='submit' name='confirmar_modificar_libro_venda'>Modificar Libro</button>
            </form>";

    if (isset($_POST['confirmar_modificar_libro_venda'])) {
        modificarLibroVenda($_POST['id'], $_POST['titulo'], $_POST['cantidade'], $_POST['descripcion'], $_POST['editorial'], $_POST['foto']);
        echo "Libro de venta modificado correctamente.";
    }

} elseif (isset($_POST['informe_aluguer'])) {
    echo "<h3>Informe de libros e cómics para aluguer</h3>";
    ver_libroscomics_aluguer();
} elseif (isset($_POST['informe_venda'])) {
    echo "<h3>Informe de libros e cómics para venda</h3>";
    ver_libroscomics_venda();
} elseif (isset($_POST['pasar_devoltos'])) {
    pasar_libros_devoltos();
    echo "Libros devoltos pasados a aluguer correctamente.";
}
?>