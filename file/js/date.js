const fechaActual = new Date();
const fecha = fechaActual.toISOString().split('T')[0];
const hora = fechaActual.toTimeString().split(' ')[0];

document.getElementById('fecha').value = fecha;
document.getElementById('hora').value = hora;