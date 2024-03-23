<?php
// Configuración de la conexión a MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pedidos";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el pedido del usuario
    $pedido = $_POST['pedido'];
    
    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
    
    // Insertar el pedido en la tabla "pedidos"
    $sql = "INSERT INTO pedidos (cancion) VALUES ('$pedido')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error al realizar el pedido: " . $conn->error;
        $conn->close();
        exit();
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
    
    // Mostrar mensaje de éxito
    echo "¡Pedido realizado con éxito!";
} else {
    // Redireccionar si se accede directamente a este archivo
    header("Location: index.html");
    exit();
}
