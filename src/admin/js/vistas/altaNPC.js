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
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);//Control de errores
            alert('Error al dar de alta al NPC'); //Lanza un mensaje si hubo algún problema al modificar el diálogo
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
        alert ('Rellena el nombre del NPC.');//Muestra un mensaje cuando el nombre está vacío
        return false;// Detener el envío
    }

    if(nombreNpc.length > maxCaracteres){ //Comprueba que el nombre del diálogo no supere los 30 caracteres
        alert(`El nombre del NPC no puede superar los ${maxCaracteres} caracteres.`);//Lanza un mensaje si supera el número de caracteres
        return false;// Detener el envío
    }

    if (sprite.length === 0){ //Comprueba que se suba la imagen
        alert ("Debes subir la imagen del NPC"); //Lanza un mensaje si la imagen no se ha subido
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
        alert(`La imagen tiene que tener la extensión PNG, JPG o JPEG.`)//Si no,lanza un mensaje
        return false;//Detiene el envío
    }

    if(imagen.size > tamanioMaxImg){//Comprobamos que la imagen no exceda del tamaño máximo permitido
        alert("La imagen seleccionada, supera el tamaño máximo (10KB)"); //Lanza un mensaje
        return false;//Detiene el envío
    }

    return true;//Retorna true

}

