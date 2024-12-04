function eliminarPersonaje(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este personaje?")) {
        fetch('index.php?c=personaje&m=eliminarPersonaje&id=' + id)
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar el mensaje devuelto por el servidor
                window.location.reload();  // Recargar la página para actualizar la lista
            })
            .catch(error => {
                console.error('Error al eliminar el personaje:', error);
                alert('Ocurrió un error al eliminar el personaje.');
            });
    }
}
