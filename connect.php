<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "catalogo";
$port= 3308;

// Create connection
$conn = new mysqli($servername, $username, $password,$database,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully"."<br>";
if ($conn->ping()){
    echo "La conexión sigue abierta";
    $conn->close();
} else {
    echo "La conexión se ha cerrado";
}
?>