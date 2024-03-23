<?php
// Archivo eliminar_pedido.php

if(isset($_POST['id'])) {
    // Obtener el ID del pedido desde la solicitud POST
    $pedidoId = $_POST['id'];

    // Realizar la conexión a la base de datos (Asegúrate de ajustar los valores según tu configuración)
    $conexion = new mysqli('localhost', 'root', '', 'pedidos');

    // Verificar si hay algún error en la conexión
    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }

    // Actualizar el campo 'activo' a 'inactivo' en la tabla 'pedidos'
    $query = "UPDATE pedidos SET activo = 'inactivo' WHERE id = ?";
    $statement = $conexion->prepare($query);
    $statement->bind_param('i', $pedidoId);
    $resultado = $statement->execute();

    // Verificar si la actualización se realizó correctamente
    if ($resultado) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo 'No se proporcionó el ID del pedido.';
}
?>
