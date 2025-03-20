<?php
// Iniciamos a sesión para manter os datos do usuario entre páxinas
session_start();

// Incluímos o modelo
include_once("../Models/usuarios.php");

// Verificamos se o usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    die("Erro: Usuario non autenticado");
}

$usuario = $_SESSION['usuario'];
$datosUsuario = obtenerUsuario($usuario);

if (!$datosUsuario) {
    die("Erro ao cargar os datos do usuario.");
}

// Extraemos as variables
$nome = $datosUsuario['nome'];
$direccion = $datosUsuario['direccion'];
$telefono = $datosUsuario['telefono'];
$nifdni = $datosUsuario['nifdni'];

// Procesar o formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_contrasinal = $_POST['contrasinal_usuario'];
    $repite_contrasinal = $_POST['repite_contrasinal'];
    $nome = $_POST['nome'];
    $direccion = $_POST['direccion_usuario'];
    $telefono = $_POST['telefono_usuario'];
    $nifdni = $_POST['dni_nif'];

    // Verificación de contrasinais
    if ($novo_contrasinal !== $repite_contrasinal) {
        echo "Erro: Os contrasinais non coinciden.";
    } else {
        // Actualizar datos
        $resultado = actualizarUsuario($usuario, $novo_contrasinal, $nome, $direccion, $telefono, $nifdni);

        if ($resultado) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Erro ao actualizar os datos.";
        }
    }
}

// Incluímos a vista
include_once("../View/conf_usuario.html");
?>