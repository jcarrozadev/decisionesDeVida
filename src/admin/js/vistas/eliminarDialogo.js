let modal = document.getElementById('modal');

function eliminarDialogo(id) { //Función que elimina el id del diálogo
    if (confirm("¿Estás seguro de que deseas eliminar este diálogo?")) { // ESTO DEBERIA CAMBIARSE A MODAL
        fetch('index.php?c=dialogo&m=eliminarDialogo&id=' + id)
            .then(response => response.text())
            .then(data => {
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Dialogo eliminado';
                document.getElementById('mensajeModal').innerHTML = data; // Mostrar el mensaje devuelto por el servidor
                //window.location.reload();  // Recargar la página para actualizar la lista
            })
            .catch(error => {
                console.error('Error al eliminar el diálogo:', error);
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Error';
                document.getElementById('mensajeModal').innerHTML = 'Error al eliminar el diálogo'; // Mostrar el mensaje devuelto por el servidor
            });
    }
}
