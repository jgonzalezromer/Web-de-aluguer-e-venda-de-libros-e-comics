<?php
// Iniciamos a sesión para manter os datos do usuario autenticado
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluímos o modelo
include_once('../Models/libroscomics.php');
include_once('../View/compra_libroscomics.html');

// Verificamos se se enviou o formulario de compra
if (isset($_POST['comprar'])) {
    // Obtemos o título do libro e o nome do comprador
    $titulo = $_POST['titulo'];
    $comprador = $_SESSION['usuario'];

    // Chamamos á función para actualizar o stock do libro comprado
    actualizar_stock_libro($titulo);

    // Creamos o contido do comprobante de compra
    $comprobante = "Comprobante de compra\n";
    $comprobante .= "Libro/Cómic: $titulo\n";
    $comprobante .= "Comprador: $comprador\n";
    $comprobante .= "Data da compra: " . date('Y-m-d H:i:s') . "\n";

    // Xeramos un nome único para o ficheiro do comprobante
    $nome_ficheiro = "comprobante_" . time() . ".txt";
    file_put_contents($nome_ficheiro, $comprobante);

    // Mostramos unha mensaxe de éxito cunha ligazón para descargar o comprobante
    echo "Compra realizada con éxito. Comprobante xerado: <a href='$nome_ficheiro'>Descargar comprobante</a>";
}
?>