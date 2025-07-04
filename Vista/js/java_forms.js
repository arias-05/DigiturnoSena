function cita(pagina = 1) {
            var cod = $("#filtro").val();
            var url = "index.php?accion=consultartablacita&codigo=" + cod + "&pagina=" + pagina;
            $("#citas").load(url);
}

function citausu(pagina = 1) {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablacitausu&codigo=" + cod + "&pagina=" + pagina;
    $("#citasusu").load(url);
}

function citafun(pagina = 1) {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablacitafun&codigo=" + cod + "&pagina=" + pagina;
    $("#citasfun").load(url);
}

function Mostrartipousu() {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablatipousu&codigo="+cod+"";
    $("#tipousuario").load(url);
}


document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('actualizartipousu'));
        myModal.show();
    }
});


function Mostrarregistro(pagina = 1) {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablaregistro&codigo="+cod+"&pagina=" + pagina;
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


document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('edit')) {
        const myModal = new bootstrap.Modal(document.getElementById('actualizartipofuncionario'));
        myModal.show();
    }
});

function Mostrarfuncionarios(pagina = 1) {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablafuncionarios&codigo="+cod+"&pagina=" + pagina;
    $("#funcionarios").load(url);
}

function cambiarEstadoFunId(numero, nuevoEstado) {
    var accion = nuevoEstado === 'Activo' ? 'activar' : 'inactivar';
    if (confirm("¿Estás seguro de que deseas " + accion + " este funcionario " + numero + "?")) {
        $.get("index.php", { accion: "cambiarEstadoCuentaFuncionario", numero: numero, nuevoEstado: nuevoEstado }, function (mensaje) {
            alert(mensaje);
            Mostrarfuncionarios(); 
        });
    }
}

function Mostraradministradores(pagina = 1) {
    var cod = $("#filtro").val();
    var url = "index.php?accion=consultartablaadmin&codigo=" + cod + "&pagina=" + pagina;
    $("#administrador").load(url);
}



function cambiarEstadoAdminId(numero, nuevoEstado) {
    var accion = nuevoEstado === 'Activo' ? 'activar' : 'inactivar';
    if (confirm("¿Estás seguro de que deseas " + accion + " este Administrador " + numero + "?")) {
        $.get("index.php", { accion: "cambiarEstadoCuentaAdmin", numero: numero, nuevoEstado: nuevoEstado }, function (mensaje) {
            alert(mensaje);
            Mostraradministradores(); 
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

