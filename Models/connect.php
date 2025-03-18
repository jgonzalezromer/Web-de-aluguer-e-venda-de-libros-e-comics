<?php

// Credenciais para o inicio de sesion en mysql
$servername = "localhost";
$username = "root";
$password = "";
$database = "catalogo";
$port= 3308;

// Creamos a conexión con mysql
$conn = new mysqli($servername, $username, $password,$database,$port);

// Comprobar se hai un erro ao conectar 
if ($conn->connect_error) {
    // Con die detemos o script
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "<h1>Conexión establecida</h1>";
}
?>