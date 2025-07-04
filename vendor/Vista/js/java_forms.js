function cita(){
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablacita&codigo="+cod+"";
    $("#citas").load(url);
}


function Mostrartipousu() {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablatipousu&codigo="+cod+"";
    $("#tipousuario").load(url);
}

function eliminarTuDetalle(numero) {
    if (confirm("¿Estas seguro de que deseas eliminar este tipo usuario " + numero + "?")) {
        $.get("index.php", { accion: "eliminarTuDetalle", numero: numero }, function (mensaje) {
            alert(mensaje);
            Mostrartipousu()
        });

    }
}
document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('actualizartipousu'));
        myModal.show();
    }
});


function Mostrarregistro() {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablaregistro&codigo="+cod+"";
    $("#usuario").load(url);
}



function cambiarEstadoUsuId(numero, nuevoEstado) {
    if (confirm("¿Estás seguro de que deseas " + (nuevoEstado === 'activo' ? 'activar' : 'inactivar') + " este usuario " + numero + "?")) {
        $.get("index.php", { accion: "cambiarEstadoCuenta", numero: numero, nuevoEstado: nuevoEstado }, function (mensaje) {
            alert(mensaje);
            Mostrarregistro(); 
        });
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('Registrar'));
        myModal.show();
    }
});

function Mostrartipofuncio() {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablatipofuncio&codigo="+cod+"";
    $("#tipofuncionario").load(url);
}

function eliminarTipoFunId(numero) {
    if (confirm("¿Estas seguro de que deseas eliminar este usuario" + numero + "?")) {
        $.get("index.php", { accion: "eliminarTipoFunId", numero: numero }, function (mensaje) {
            alert(mensaje);
            Mostrartipofuncio();
        });
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('actualizartipofuncionario'));
        myModal.show();
    }
});

function Mostrarfuncionarios() {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablafuncionarios&codigo="+cod+"";
    $("#funcionarios").load(url);
}

function cambiarEstadoFunId(numero, nuevoEstado) {
    if (confirm("¿Estás seguro de que deseas " + (nuevoEstado === 'activo' ? 'activar' : 'inactivar') + " este funcionario " + numero + "?")) {
        $.get("index.php", { accion: "cambiarEstadoCuentaFuncionario", numero: numero, nuevoEstado: nuevoEstado }, function (mensaje) {
            alert(mensaje);
            Mostrarfuncionarios(); 
        });
    }
}
document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('Registrarfun'));
        myModal.show();
    }
});


$(document).ready(function () {
    $('#loginUserBtn').click(function () {
        $('.login-form').hide();
        $('#loginUserForm').toggle();
    });
    $('#loginAdminBtn').click(function () {
        $('.login-form').hide();
        $('#loginAdminForm').toggle();
    });
    $('#loginGuestBtn').click(function () {
        $('.login-form').hide();
        $('#loginGuestForm').toggle();
    });
});

