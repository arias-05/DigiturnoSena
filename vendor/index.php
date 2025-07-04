<?php
ob_start(); // Iniciar el buffering de salida

session_start(); // Inicia la sesión al principio del script

// Mostrar todos los errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Incluye todos los controladores necesarios
require_once("Controlador/controladorAdministrador.php");
require_once("Controlador/controladorTipoUsuario.php");
require_once("Controlador/controladorFuncionario.php");
require_once("Controlador/controladorUsuario.php");
require_once("Controlador/controladorTipoFuncionario.php");
require_once("Controlador/controladorCita.php");

// Incluye la clase de conexión
require_once("Modelo/Conexion.php");

// Incluye los gestores y modelos necesarios
require_once("Modelo/gestorAdministrador.php");
require_once("Modelo/gestorFuncionario.php");
require_once("Modelo/gestorTipoUsuario.php");
require_once("Modelo/gestorusuario.php");
require_once("Modelo/gestorTipoFuncionario.php");
require_once("Modelo/gestorCitas.php");

// Incluye PHPMailer y archivos relacionados
require_once("Vista/PHPMailer-master/src/PHPMailer.php");
require_once("Vista/PHPMailer-master/src/Exception.php");
require_once("Vista/PHPMailer-master/src/SMTP.php");
require_once("Modelo/EnvioCorreo.php");

// Incluye todos los modelos necesarios
require_once("Modelo/administrador.php");
require_once("Modelo/tipoUsuario.php");
require_once("Modelo/usuario.php");
require_once("Modelo/tipoFuncionario.php");
require_once("Modelo/funcionario.php");
require_once("Modelo/turno.php");

// Incluye autoload para otras dependencias
require_once("vendor/autoload.php");

// Crea instancias de los controladores
$controladorFuncionario = new ControladorFuncionario();
$controladortipofuncionario = new Controladortipofuncionario();
$controladorAdministrador = new ControladorAdministrador();
$controladorUsuario = new ControladorUsuario();
$controladortipousuario = new Controladortipousuario();
$controladorCita = new ControladorCita();


// Lógica de enrutamiento basada en sesiones
if (isset($_SESSION['AdminId']) && isset($_SESSION["AdminNom"]) && isset($_SESSION["AdminApel"]) && isset($_SESSION["AdminTel"]) && isset($_SESSION["AdminCorreo"]) && isset($_SESSION["AdminContra"])) {
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        if ($accion === 'logoutAdmin') {
            $controladorAdministrador->logoutAdmin();
        } elseif ($accion === 'tablatipousuario') {
            require_once("Vista/html/tablatipousuario.php");
        } elseif ($accion === 'insertarTipoUsu') {
            $controladortipousuario->insertarTipoUsuario($_REQUEST["TuDetalle"]);
        } elseif ($accion === 'consultartablatipousu') {
            $codigo = $_GET["codigo"];
            $controladortipousuario->consultarTablaTipousUario($codigo);
        } elseif ($accion === 'eliminarTuDetalle') {
            $controladortipousuario->eliminarTuDetalle($_GET["numero"]);
        } elseif ($accion === 'modificartipousu') {
            $controladortipousuario->modificarTipoUsuario($_GET["edit"]);
        } elseif ($accion === 'actualizartipousu') {
            $controladortipousuario->actualizarTipoUsuario(
                $_REQUEST["TuId"],
                $_REQUEST["TuDetalle"]
            );
        } elseif ($accion === 'tablaregistros') {
            $controladorUsuario->agregarTipoUsuario();
        } elseif ($accion === 'registrarusuario') {
            $controladorUsuario->registrarUsuario(
                $_REQUEST["UsuId"],
                $_REQUEST["UsuNombre"],
                $_REQUEST["UsuApellido"],
                $_REQUEST["UsuCorreo"],
                $_REQUEST["UsuTelefono"],
                $_REQUEST["Usucontra"],
                $_REQUEST["Estado"],
                $_REQUEST["TuId"]
            );
        } elseif ($accion === 'consultartablaregistro') {
            $codigo = $_GET["codigo"];
            $controladorUsuario->consultarTablaUsuario($codigo);
        } elseif ($accion === 'cambiarEstadoCuenta') {
            $controladorUsuario->cambiarEstadoCuenta($_GET['numero'], $_GET['nuevoEstado']);
        } elseif ($accion === 'modificarregistros') {
            $controladorUsuario->modificarUsuario($_GET["edit"]);
        } elseif ($accion === 'actualizarregistro') {
            $controladorUsuario->actualizarUsuario(
                $_REQUEST["UsuId"],
                $_REQUEST["UsuNombre"],
                $_REQUEST["UsuApellido"],
                $_REQUEST["UsuCorreo"],
                $_REQUEST["UsuTelefono"],
                $_REQUEST["Usucontra"],
                $_REQUEST["Estado"],
                $_REQUEST["TuId"]
            );
        } elseif ($accion === 'tablatipofuncionarios') {
            require_once("Vista/html/tablatipofuncionarios.php");
        } elseif ($accion === 'insertarTipofuncio') {
            $controladortipofuncionario->insertarTipoFuncionario($_REQUEST["TipoFncionario"]);
        } elseif ($accion === 'consultartablatipofuncio') {
            $codigo = $_GET["codigo"];
            $controladortipofuncionario->consultarTablaTipoFuncionario($codigo);
        } elseif ($accion === 'eliminarTipoFunId') {
            $controladortipofuncionario->eliminarTipoFunId($_GET["numero"]);
        } elseif ($accion === 'modificartipofuncionarios') {
            $controladortipofuncionario->modificarTipoFuncionarios($_GET["edit"]);
        } elseif ($accion === 'actualizartipofunci') {
            $controladortipofuncionario->actualizarTipoFuncinario(
                $_REQUEST["TipoFunId"],
                $_REQUEST["TipoFncionario"]
            );
        } elseif ($accion === 'tablafuncionarios') {
            $controladorFuncionario->agregarTipoFuncionario();
        } elseif ($accion === 'RegistrarFuncionario') {
            $controladorFuncionario->RegistrarFuncionario(
                $_REQUEST["FunId"],
                $_REQUEST["FunNombre"],
                $_REQUEST["FunApellido"],
                $_REQUEST["FunTelefono"],
                $_REQUEST["FunCorreo"],
                $_REQUEST["FunContrasena"],
                $_REQUEST["Estado"],
                $_REQUEST["TipoFunId"]
            );
        } elseif ($accion === 'consultartablafuncionarios') {
            $codigo = $_GET["codigo"];
            $controladorFuncionario->consultarTablaFuncionario($codigo);
        } elseif ($accion === 'cambiarEstadoCuentaFuncionario') {
            $controladorFuncionario->cambiarEstadoCuentaFuncionario($_GET['numero'], $_GET['nuevoEstado']);
        } elseif ($accion === 'modificarregistrofuncio') {
            $controladorFuncionario->modificarRegistroFuncionario($_GET["edit"]);
        } elseif ($accion === 'actualizarfuncionarios') {
            $controladorFuncionario->actualizarFuncionario(
                $_REQUEST["FunId"],
                $_REQUEST["FunNombre"],
                $_REQUEST["FunApellido"],
                $_REQUEST["FunTelefono"],
                $_REQUEST["FunCorreo"],
                $_REQUEST["FunContrasena"],
                $_REQUEST["Estado"],
                $_REQUEST["TipoFunId"]
            );
        } elseif ($accion === 'vistaadministrador') {
            require_once("Vista/html/vistaadministrador.php");
        } elseif ($accion === 'consultartablacita') {
            $codigo = $_GET["codigo"];
            $controladorCita->consultarTablaCita($codigo);
        } elseif ($accion === 'registrocitas') {
            $FechaInicio = $_POST['FechaInicio'];
            $FechaFin = $_POST['FechaFin'];
            $controladorCita->registroCitas($FechaInicio, $FechaFin);
        } else {
            header("Location:index.php?accion=inicio");
            exit();
        }
    } else {
        header("Location:index.php?accion=inicio");
        exit();
    }
} elseif (isset($_SESSION['UsuId']) && isset($_SESSION["UsuNombre"]) && isset($_SESSION["UsuApellido"]) && isset($_SESSION["UsuCorreo"]) && isset($_SESSION["UsuTelefono"]) && isset($_SESSION["Usucontra"]) && isset($_SESSION["TuId"]) && isset($_SESSION["Estado"])) {
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        if ($accion === 'vistausuario') {
            $controladorCita->agregaFuncionario();
        } elseif ($accion === 'logoutUsu') {
            $controladorUsuario->logoutUsu();
        } elseif ($accion === 'consultartablacita') {
            $codigo = $_GET["codigo"];
            $controladorCita->consultarTablaCita($codigo);
        } elseif ($accion === 'registrarcita') {
            $controladorCita->registrarCita(
                $_REQUEST["TurnHFSoli"],
                $_REQUEST["TurnDetalle"],
                $_REQUEST["FunId"],
                $_REQUEST["UsuId"],
                $_REQUEST["TuId"],
                $_REQUEST["Estado"]
            );
        } elseif ($accion === 'cancelarcita') {
            $controladorCita->cancelarCita(
                $_POST["TurnoId"],
                $_POST["TurnHFSoli"],
                $_POST["TurnHAsig"],
                $_POST["TurnDetalle"],
                $_POST["TurnObserva"],
                $_POST["FunId"],
                $_POST["UsuId"],
                $_POST["TuId"],
                $_POST["Estado"]
            );
        } elseif ($accion  === 'editarcitausu') {
            $controladorCita->editarCitaUsu(
                $_POST["TurnoId"],
                $_POST["TurnHFSoli"],
                $_POST["TurnHAsig"],
                $_POST["TurnDetalle"],
                $_POST["TurnObserva"],
                $_POST["FunId"],
                $_POST["UsuId"],
                $_POST["TuId"],
                $_POST["Estado"]
            );
        } elseif ($accion === 'actualizarPerfil') {
            $controladorUsuario->actualizarPerfil(
                $_REQUEST["UsuId"],
                $_REQUEST["UsuNombre"],
                $_REQUEST["UsuApellido"],
                $_REQUEST["UsuCorreo"],
                $_REQUEST["UsuTelefono"],
                $_REQUEST["Usucontra"],
                $_REQUEST["Estado"],
                $_REQUEST["TuId"]
            );
        } else {
            header("Location:index.php?accion=inicio");
            exit();
        }
    } else {
        header("Location:index.php?accion=inicio");
        exit();
    }
} elseif (isset($_SESSION['FunId']) && isset($_SESSION["FunNombre"]) && isset($_SESSION["FunApellido"]) && isset($_SESSION["FunTelefono"]) && isset($_SESSION["FunCorreo"]) && isset($_SESSION["FunContrasena"]) && isset($_SESSION["TipoFunId"]) && isset($_SESSION["Estado"])) {
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
        if ($accion === 'vistafuncionario') {
            require_once("Vista/html/vistafuncionario.php");
        } elseif ($accion === 'consultartablacita') {
            $codigo = $_GET["codigo"];
            $controladorCita->consultarTablaCita($codigo);
        } elseif ($accion === 'logoutFun') {
            $controladorFuncionario->logoutFun();
        } elseif ($accion === 'agendarCitaFun') {
            $controladorCita->agendarCitaFun(
                $_POST["TurnoId"],
                $_POST["TurnHFSoli"],
                $_POST["TurnHAsig"],
                $_POST["TurnDetalle"],
                $_POST["TurnObserva"],
                $_POST["FunId"],
                $_POST["UsuId"],
                $_POST["TuId"],
                $_POST["Estado"]
            );
        } elseif ($accion === 'editarCitaAsignada') {
            $controladorCita->editarCitaAsignada(
                $_POST["TurnoId"],
                $_POST["TurnHFSoli"],
                $_POST["TurnHAsig"],
                $_POST["TurnDetalle"],
                $_POST["TurnObserva"],
                $_POST["FunId"],
                $_POST["UsuId"],
                $_POST["TuId"],
                $_POST["Estado"]
            );
        } elseif ($accion === 'terminarCita') {
            $controladorCita->terminarCita(
                $_POST["TurnoId"],
                $_POST["TurnHFSoli"],
                $_POST["TurnHAsig"],
                $_POST["TurnDetalle"],
                $_POST["TurnObserva"],
                $_POST["FunId"],
                $_POST["UsuId"],
                $_POST["TuId"],
                $_POST["Estado"]
            );
        } elseif ($accion === 'registroCitasFuncionario') {
            $FechaInicio = $_POST['FechaInicio'];
            $FechaFin = $_POST['FechaFin'];
            $controladorCita->registroCitasFuncionario($FechaInicio, $FechaFin);
        } elseif ($accion === 'actualizarPerfilFuncionario') {
            $controladorFuncionario->actualizarPerfilFuncionario(
                $_REQUEST["FunNombre"],
                $_REQUEST["UsuNombre"],
                $_REQUEST["UsuApellido"],
                $_REQUEST["UsuCorreo"],
                $_REQUEST["UsuTelefono"],
                $_REQUEST["Usucontra"],
                $_REQUEST["Estado"],
                $_REQUEST["TuId"]
            );
        } else {
            header("Location:index.php?accion=inicio");
            exit();
        }
    } else {
        header("Location:index.php?accion=inicio");
        exit();
    }
} else {
    if (isset($_GET['accion'])) {
        $accion = $_GET['accion'];
    
        // Definir las acciones públicas permitidas
        $acciones_publicas = [
            'inicio',
            'loginUsuario',
            'olvidarContrasenaUsuario',
            'loginFuncionario',
            'olvidarContrasenaFuncionario',
            'loginAdministrador',
            'olvidarContrasenaAdministrador',
        ];
    
        // Verificar si la acción está en las acciones públicas permitidas
        if (in_array($accion, $acciones_publicas)) {
            // Ejecutar la acción pública correspondiente
            switch ($accion) {
                case 'inicio':
                    require_once('Vista/html/inicio.php');
                    break;
                case 'loginUsuario':
                    $controladorUsuario->loginUsuario($_REQUEST["UsuId"], $_REQUEST["Usucontra"]);
                    break;
                case 'olvidarContrasenaUsuario':
                    $controladorUsuario->olvidarContrasenaUsuario($_POST["UsuId"]);
                    break;
                case 'loginFuncionario':
                    $controladorFuncionario->loginFuncionario($_REQUEST["FunId"], $_REQUEST["FunContrasena"]);
                    break;
                case 'olvidarContrasenaFuncionario':
                    $controladorFuncionario->olvidarContrasenaFuncionario($_POST["FunId"]);
                    break;
                case 'loginAdministrador':
                    $controladorAdministrador->loginAdministrador($_REQUEST["AdminId"], $_REQUEST["AdminContra"]);
                    break;
                case 'olvidarContrasenaAdministrador':
                    $controladorAdministrador->olvidarContrasenaAdministrador($_REQUEST["AdminId"]);
                    break;
                default:
                    // Acción no reconocida, redirigir al inicio
                    header("Location:index.php?accion=inicio");
                    break;
            }
        } else {
            // Acción no permitida públicamente, redirigir al inicio
            header("Location:index.php?accion=inicio");
        }
    } else {
        // No se especificó ninguna acción, mostrar la página de inicio por defecto
        header("Location:index.php?accion=inicio");
    }
}    