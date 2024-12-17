let modal = document.getElementById('modal');

//Coge el formulario por su id y a través del evento detiene el envío del formulario cuando se clique en el botón 'submit'
document.getElementById('npcForm').addEventListener('submit', function(event) {
    event.preventDefault();  /*Evita el envío tradicional del formulario*/

    if (!confirm('¿Estás seguro que deseas dar de alta al NPC?')) { return; } //Mensaje de confirmación de si se desea dar de alta al npc

    if (validarAlta()) { //Si la función validarAlta retorna true lo envía

        let formData = new FormData(this);

        fetch('index.php?c=npc&m=altaNPC', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Muestra la respuesta del servidor en la consola
            // modal.style.display = 'block';
            // document.getElementById('tituloModal').innerHTML = 'NPC eliminado';
            // document.getElementById('mensajeModal').innerHTML = data; // Mostrar el mensaje devuelto por el servidor
            alert(data);
            window.location.href = 'index.php?c=npc&m=listarNPC'; // Redireccionar a la lista de NPCs
        })
        .catch(error => {
            console.error('Error:', error);//Control de errores
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'Error al dar de alta al NPC'; // Mostrar el mensaje devuelto por el servidor
        });
    }
});
//-------Función que valida todos los campos del formulario----------
function validarAlta(){
    //Cogemos los valores del forulario por su id y lo almacenamos en variables
    let nombreNpc = document.getElementById('nombre').value.trim();
    let sprite = document.getElementById('npcSprite').files;

    const tamanioMaxImg = 10240; //Tamaño máximo de archivo en bytes (1MB)1048576
    const maxCaracteres = 30;    // Máximo de caracteres permitidos en el nombre

    if (!nombreNpc) {//Comprueba que exista el nombre del npc
        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Error';
        document.getElementById('mensajeModal').innerHTML = 'Rellena el nombre del NPC.'; // Mostrar el mensaje devuelto por el servidor
        return false;// Detener el envío
    }

    if(nombreNpc.length > maxCaracteres){ //Comprueba que el nombre del diálogo no supere los 30 caracteres
        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Error';
        document.getElementById('mensajeModal').innerHTML = `El nombre del NPC no puede superar los ${maxCaracteres} caracteres.`; // Mostrar el mensaje devuelto por el servidor
        return false;// Detener el envío
    }

    if (sprite.length === 0){ //Comprueba que se suba la imagen
        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Error';
        document.getElementById('mensajeModal').innerHTML = "Debes subir la imagen del NPC"; // Mostrar el mensaje devuelto por el servidor
        return false;// Detener el envío
    }

    if (!validarImg(sprite[0], tamanioMaxImg)){ //Si la funcion validarImg retorna false
        return false;// Detener el envío
    }

    return true; //Si pasa todas las validaciones lo envía
    
}

//--------Función Validar Imagen-----------
function validarImg(imagen,tamanioMaxImg){

    const tipoArchivo = ['image/png', 'image/jpeg', 'image/jpg']; //Tipos de archivo válidos

    if (!tipoArchivo.includes(imagen.type)){ //Comprobamos que la imagen incluya alguno de esos tipos de archivo
        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Error';
        document.getElementById('mensajeModal').innerHTML = `La imagen tiene que tener la extensión PNG, JPG o JPEG.`; // Mostrar el mensaje devuelto por el servidor
        return false;//Detiene el envío
    }

    if(imagen.size > tamanioMaxImg){//Comprobamos que la imagen no exceda del tamaño máximo permitido
        modal.style.display = 'block';
        document.getElementById('tituloModal').innerHTML = 'Error';
        document.getElementById('mensajeModal').innerHTML = `La imagen seleccionada, supera el tamaño máximo (10KB)`; // Mostrar el mensaje devuelto por el servidor
        return false;//Detiene el envío
    }

    return true;//Retorna true

}

