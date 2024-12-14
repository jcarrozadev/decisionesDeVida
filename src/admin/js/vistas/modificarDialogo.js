//Cogemos el formulario con el id y añadimos un evento para oír el botón submit
document.getElementById('formModDialogo').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    if (validarModDialogo()) { //Si la función validarModDialogo retorna true lo envía
        var formData = new FormData(this);

        fetch('index.php?c=dialogo&m=guardarDialogo', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Muestra la respuesta del servidor en la consola
            alert(data);  // Mostrar mensaje devuelto por el servidor
            window.location.href = 'index.php?c=dialogo&m=listarDialogos'; //Redirige a la vista de diálogos
        })
        .catch(error => {
            console.error('Error:', error); //Control de errores
            alert('Hubo un error al modificar el diálogo'); //Lanza un mensaje si hubo algún problema al modificar el diálogo
        });
    }
});
//-------Función que valida todos los campos del formulario----------
function validarModDialogo(){
    //Cogemos todos los valores del forulario por su id y lo almacenamos en variables
    let nombreDialogo = document.getElementById('nombre').value.trim();
    let casilla = document.getElementById('casilla').value.trim();
    let mensaje = document.getElementById('mensaje').value.trim();
    let respuesta1 = document.getElementById('respuesta1').value.trim();
    let respuesta2 = document.getElementById('respuesta2').value.trim();
    
    const maxCaracteres = 20; //Máximo de caracteres permitidos por la BBDD para el nombre

    if (!nombreDialogo) { //Comprueba que exista el nombre del diálogo
        alert('Por favor, rellena el nombre del diálogo.'); //Muestra un mensaje cuando el nombre está vacío
        return false; // Detener el envío
    }

    if(nombreDialogo.length > maxCaracteres){ //Comprueba que el nombre del diálogo no supere los 20 caracteres
        alert(`El nombre del diálogo no puede superar los ${maxCaracteres} caracteres.`); //Lanza un mensaje si supera el número de caracteres
        return false;// Detener el envío
    }

    if(!casilla) { //Si la casilla no existe muestra un mensaje
        alert('Por favor, rellena la casilla del diálogo.');
        return false; // Detener el envío
    }

    if (!mensaje) { //Si el mensaje no existe muestra un mensaje de alerta
        alert('Por favor, rellena el mensaje del diálogo.');
        return false; // Detener el envío
    }

    if (!respuesta1) { //Si la respuesta1 no existe lanza un mensaje de alerta
        alert('Por favor, rellena la respuesta 1 del diálogo.'); 
        return false; // Detener el envío
    }

    if (!respuesta2) {//Si la respuesta no existe lanza un mensaje de alerta
        alert('Por favor, rellena la respuesta 2 del diálogo.');
        return false; // Detener el envío
    }

    if (!validarCasilla(casilla)) return false; //Si el método que valida la casilla retorna false. Detiene el envío

    return true; //Si pasa todas las validaciones lo envía
}
//--------Función Validar casilla-----------
function validarCasilla(casilla){
    let caracteresValidos = /^[A-J][1-9]$|^[A-J]1[0-2]$/; //Caracteres válidos para el campo de la casilla

    if (casilla.length !== 2) { //Si la longitud de la casilla no es igual a 2...
        alert('La casilla debe tener exactamente dos caracteres'); //Lanza un mensaje
        return false;// Detener el envío
    }

    if (!caracteresValidos.test(casilla)) { //Si el valor de la casilla no tiene los caracteres admitidos...
        alert('La casilla debe ser una letra de la A a la J seguida de un número del 1 al 12'); //Lanza un mensaje
        return false;// Detener el envío
    }

    return true; //Si pasa todas las validaciones lo envía

}