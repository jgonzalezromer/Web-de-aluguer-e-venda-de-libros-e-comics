<?php
session_start();

// Se non iniciou sesion facemos que volva ao inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include_once('../Models/libroscomics.php');

if (isset($_POST['comprar'])) {
    $titulo = $_POST['titulo'];
    $comprador = $_SESSION['usuario'];

    actualizar_stock_libro($titulo);

    $comprobante = "Comprobante de compra\n";
    $comprobante .= "Libro/Cómic: $titulo\n";
    $comprobante .= "Comprador: $comprador\n";
    $comprobante .= "Data da compra: " . date('Y-m-d H:i:s') . "\n";

    $nome_ficheiro = "comprobante_" . time() . ".txt";
    file_put_contents($nome_ficheiro, $comprobante);

    echo "Compra realizada con éxito. Comprobante xerado: <a href='$nome_ficheiro'>Descargar comprobante</a>";
}
?>