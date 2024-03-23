<?php
require_once('config.php'); // Asegúrate de que la ruta sea correcta
// Resto de tu código
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            background-image: url('concierto.jpg');
            background-size: cover;
            backdrop-filter: blur(10px);
        }
        
        .pedido-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .pedido {
            width: 200px;
            height: 200px;
            color: #fff;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            word-wrap: break-word;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Lista de Pedidos</h1>
    
    <div class="pedido-container" id="pedido-container">
        <!-- Aquí se mostrarán los pedidos -->
    </div>
    
    <script>
        // Función para obtener los pedidos y actualizar el contenido
        function obtenerPedidos() {
            // Obtén la referencia al contenedor de pedidos
            var pedidoContainer = document.getElementById('pedido-container');

            // Realiza una solicitud GET para obtener los pedidos desde el servidor
            fetch('get_pedidos.php')
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    // Borra los pedidos existentes en el contenedor
                    pedidoContainer.innerHTML = '';

                    // Recorre los pedidos y crea un cuadro para cada uno
                    data.forEach(function(pedido) {
                        if (pedido.activo === '1') {
                            var pedidoDiv = document.createElement('div');
                            pedidoDiv.classList.add('pedido');
                            pedidoDiv.textContent = pedido.cancion;

                            // Genera un color de fondo aleatorio en JavaScript
                            var color = getRandomColor();
                            pedidoDiv.style.backgroundColor = color;

                            // Agrega el evento de clic para eliminar el pedido
                            pedidoDiv.addEventListener('click', function() {
                                if (confirm('¿Deseas eliminar el pedido?')) {
                                    eliminarPedido(pedido.id, pedidoDiv);
                                }
                            });

                            pedidoContainer.appendChild(pedidoDiv);
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Error al obtener los pedidos:', error);
                });
        }

        // Genera un color de fondo aleatorio en JavaScript
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Elimina un pedido mediante una solicitud POST
        function eliminarPedido(pedidoId, pedidoDiv) {
            fetch('eliminar_pedido.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(pedidoId)
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    pedidoDiv.remove(); // Elimina el cuadro del pedido de la interfaz
                } else {
                    console.error('Error al eliminar el pedido.');
                }
            })
            .catch(function(error) {
                console.error('Error al eliminar el pedido:', error);
            });
        }

        // Actualiza automáticamente los pedidos cada 5 segundos
        setInterval(obtenerPedidos, 5000);

        // Obtiene los pedidos al cargar la página por primera vez
        obtenerPedidos();
    </script>
</body>
</html>
