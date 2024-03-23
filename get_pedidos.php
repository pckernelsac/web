<?php
// Configuración de la conexión a MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pedidos";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los pedidos desde la tabla "pedidos" ordenados por fecha de pedido descendente
$sql = "SELECT id, cancion, fecha_pedido, activo FROM pedidos ORDER BY fecha_pedido DESC";
$result = $conn->query($sql);

// Verificar si la consulta se realizó correctamente
if (!$result) {
    die("Error al obtener los pedidos: " . $conn->error);
}

// Crear un array para almacenar los pedidos
$pedidos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Enviar los pedidos como una respuesta JSON
header('Content-Type: application/json');
echo json_encode($pedidos);
?>
