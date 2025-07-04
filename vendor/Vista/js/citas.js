// java_forms.js

// Función para validar la fecha y hora solicitada
function validarFechaHoraSolicitada(fechaHoraInput) {
    // Convertir el valor del input a un objeto de fecha JavaScript
    var fechaHoraSeleccionada = new Date(fechaHoraInput.value);
    
    // Obtener la fecha y hora actual
    var fechaHoraActual = new Date();
    
    // Validar que la fecha y hora seleccionada sea mayor a la fecha y hora actual
    if (fechaHoraSeleccionada > fechaHoraActual) {
        // Verificar que sea un día laborable (de lunes a viernes)
        var diaSemana = fechaHoraSeleccionada.getDay(); // Domingo=0, Lunes=1, ..., Sábado=6
        if (diaSemana >= 1 && diaSemana <= 5) {
            // Verificar horario permitido (de 8 a 12 y de 14 a 17)
            var horaSeleccionada = fechaHoraSeleccionada.getHours();
            if ((horaSeleccionada >= 8 && horaSeleccionada < 12) || (horaSeleccionada >= 14 && horaSeleccionada < 17)) {
                // Cumple con todas las condiciones, se puede enviar el formulario
                return true;
            } else {
                alert('La hora seleccionada debe estar dentro del horario laboral de lunes a viernes (8-12 y 14-17).');
                return false;
            }
        } else {
            alert('La fecha seleccionada no es un día laborable (lunes a viernes).');
            return false;
        }
    } else {
        alert('La fecha y hora seleccionada deben ser superior a la fecha y hora actual.');
        return false;
    }
}


