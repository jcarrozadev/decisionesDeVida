function eliminarDialogo(id) { //Función que elimina el id del diálogo
    if (confirm("¿Estás seguro de que deseas eliminar este diálogo?")) { //Mensaje que confirma que se quiera eliminar ese registro.
        fetch('index.php?c=dialogo&m=eliminarDialogo&id=' + id)
            .then(response => response.text())
            .then(data => {
                alert(data);  // Mostrar el mensaje devuelto por el servidor
                window.location.reload();  // Recargar la página para actualizar la lista
            })
            .catch(error => {
                console.error('Error al eliminar el diálogo:', error);
                alert('Ocurrió un error al eliminar el diálogo.');
            });
    }
}
