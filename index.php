<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Pedidos Musicales</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Estilo para el fondo de la página */
        body {
            background-image: url('concierto.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        /* Estilos para el contenedor principal */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%; /* Ancho máximo del formulario y ajustado para dispositivos móviles */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Estilos para el botón */
        .btn {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos para el mensaje de respuesta */
        #response {
            margin-top: 20px;
        }

        /* Estilos para el fondo del mensaje */
        #message {
            background-color: rgba(0, 123, 255, 0.8);
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        /* Estilos para el logotipo */
        #logo {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }

        /* Estilos para el campo de entrada */
        #pedido-input {
            width: 100%;
            box-sizing: border-box;
        }

        /* Estilos para pantallas pequeñas (móviles) */
        @media (max-width: 768px) {
            .form-container {
                width: 100%; /* Cambia el ancho al 100% para dispositivos móviles */
            }
        }
    </style>
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Logotipo -->
            <img id="logo" src="logo.png" alt="Logo de la empresa">
            
            <h1>Sistema de Pedidos Musicales</h1>
            
            <form id="order-form" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="pedido-input">Escribe tu pedido:</label>
                    <input type="text" name="pedido" id="pedido-input" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">Realizar Pedido</button>
                </div>
            </form>

            <div id="response">
                <span id="message"></span>
            </div>
        </div>
    </div>

    <script>
        function validarFormulario() {
            var pedidoInput = document.getElementById('pedido-input');
            var mensaje = document.getElementById('message');
            
            if (pedidoInput.value.trim() === '') {
                mensaje.style.backgroundColor = 'red';
                mensaje.style.display = 'block';
                mensaje.textContent = 'Por favor, ingresa un pedido antes de enviarlo.';
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
