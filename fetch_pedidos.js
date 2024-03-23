window.addEventListener('DOMContentLoaded', function() {
    // Obtén la referencia al contenedor de pedidos
    var pedidoContainer = document.getElementById('pedido-container');

    // Realiza una solicitud GET para obtener los pedidos desde el servidor
    fetch('get_pedidos.php')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            // Recorre los pedidos y crea un cuadro para cada uno
            data.forEach(function(pedido) {
                var pedidoDiv = document.createElement('div');
                pedidoDiv.classList.add('pedido');
                pedidoDiv.textContent = pedido.cancion;

                // Genera un color de fondo aleatorio
                var color = getRandomColor();
                pedidoDiv.style.backgroundColor = color;

                pedidoContainer.appendChild(pedidoDiv);
            });
        })
        .catch(function(error) {
            console.error('Error al obtener los pedidos:', error);
        });
});

// Genera un color de fondo aleatorio
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
