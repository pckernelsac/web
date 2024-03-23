window.addEventListener('load', function() {
    var form = document.getElementById('order-form');
    var responseDiv = document.getElementById('response');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(form);
        
        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            responseDiv.textContent = data;
            form.reset(); // Limpiar el formulario después del envío exitoso
        })
        .catch(function(error) {
            responseDiv.textContent = 'Error al procesar el pedido.';
            console.error(error);
        });
    });
});
// Obtén la referencia al elemento del mensaje
var messageElement = document.getElementById('message');

// Función para mostrar el mensaje durante un tiempo determinado
function mostrarMensaje(mensaje, tiempo) {
    // Asigna el mensaje al elemento del mensaje
    messageElement.textContent = mensaje;

    // Muestra el elemento del mensaje
    messageElement.style.display = 'block';

    // Oculta el mensaje después de cierto tiempo
    setTimeout(function() {
        messageElement.style.display = 'none';
    }, tiempo);
}

// Captura el evento de envío del formulario
document.getElementById('order-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    // Realiza el pedido y muestra el mensaje de éxito
    realizarPedido()
        .then(function() {
            mostrarMensaje('Pedido realizado correctamente', 2000);
        })
        .catch(function(error) {
            console.error('Error al realizar el pedido:', error);
        });
});

// Función para realizar el pedido (simulada)
function realizarPedido() {
    return new Promise(function(resolve, reject) {
        // Aquí puedes realizar la lógica de envío del pedido
        // Por ahora, simplemente resolvemos la promesa después de 1 segundo
        setTimeout(function() {
            resolve();
        }, 1000);
    });
}
