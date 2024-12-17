let modal = document.getElementById('modal');

function eliminarPersonaje(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este personaje?")) { // ESTO DEBERIA CAMBIARSE A MODAL
        fetch('index.php?c=personaje&m=eliminarPersonaje&id=' + id)
            .then(response => response.text())
            .then(data => {
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Personaje eliminado';
                document.getElementById('mensajeModal').innerHTML = data; // Mostrar el mensaje devuelto por el servidor
                //window.location.reload();  // Recargar la página para actualizar la lista
            })
            .catch(error => {
                console.error('Error al eliminar el personaje:', error);
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Error';
                document.getElementById('mensajeModal').innerHTML = 'Ocurrió un error al eliminar el personaje.';
            });
    }
}
