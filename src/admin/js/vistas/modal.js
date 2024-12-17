const cerrarModal = document.getElementById("cerrarModal");
const botonModal = document.getElementById("aceptarModal");

cerrarModal.addEventListener("click", () => {
    modal.style.display = "none";
});

botonModal.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});