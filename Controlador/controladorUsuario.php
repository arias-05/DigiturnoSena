<?php
class ControladorUsuario
{
    public function logoutUsu()
    {
        if (isset($_SESSION["UsuId"])) {
            unset($_SESSION["UsuId"]);
        }
        header("Location:index.php?accion=inicio");
        session_destroy();
    }


    public function consultarTablaUsuario($codigo, $pagina = 1, $porPagina = 3)
{
    $gestorUsuario = new GestorUsuario();
    $totalUsuarios = $gestorUsuario->contarUsuarios($codigo);
    $result = $gestorUsuario->consultarTablaUsuario($codigo, $pagina, $porPagina);
    require_once 'Vista/html/consultartablaregistro.php';
}
    public function registrarUsuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId)
    {
        $usuario = new Usuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId);
        $gestorUsuario = new GestorUsuario();
        $gestorUsuario->registrarUsuario($usuario);
        header("Location:index.php?accion=tablaregistros");
    }
    public function registrarUsuarios($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId)
    {
        $usuario = new Usuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId);
        $gestorUsuario = new GestorUsuario();
        $gestorUsuario->registrarUsuarios($usuario);
        header("Location:index.php?accion=inicio");
    }

    public function cambiarEstadoCuenta($numero, $nuevoEstado)
    {
        $gestorUsuario = new GestorUsuario();
        $resultado = $gestorUsuario->cambiarEstadoCuenta($numero, $nuevoEstado);

        if ($resultado) {
            echo "Cuenta " . ($nuevoEstado == 'activo' ? 'activada' : 'inactivada') . " correctamente.";
        } else {
            echo "Error al cambiar el estado de la cuenta.";
        }
    }


    public function agregarTipoUsuario()
    {
        $gestorTipoUsuario = new GestorTipoUsuario();
        $result = $gestorTipoUsuario->consultarTablaTipoUsuarios();
        require_once("Vista/html/tablaregistros.php");
    }
    public function agregaTipoUsuario()
    {
        $gestorTipoUsuario = new GestorTipoUsuario();
        $result = $gestorTipoUsuario->consultarTablaTipoUsuarios();
        require_once("Vista/html/inicio.php");
    }

    public function modificarUsuario($usuario)
    {
        $gestorUsuario =  new  GestorUsuario();
        $result = $gestorUsuario->modificarUsuario($usuario);
        $gestorTipoUsuario = new GestorTipoUsuario();
        $result2 = $gestorTipoUsuario->consultarTablaTipoUsuarios();
        require_once("Vista/html/modificarregistro.php");
    }

    public function actualizarUsuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId)
    {
        $usuario = new Usuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId);
        $gestorUsuario = new GestorUsuario();
        $resultado = $gestorUsuario->actualizarUsuario($usuario);

        if ($resultado > 0) {
            header("Location: index.php?accion=tablaregistros");
        }
    }
    
    public function actualizarPerfil($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId)
    {
        $usuario = new Usuario($UsuId, $UsuNombre, $UsuApellido, $UsuCorreo, $UsuTelefono, $Usucontra, $Estado, $TuId);
        $gestorUsuario = new GestorUsuario();
        $resultado = $gestorUsuario->actualizarPerfil($usuario);
    
        if ($resultado > 0) {
            // Actualizar datos en la sesión
            $_SESSION["UsuNombre"] = $UsuNombre;
            $_SESSION["UsuApellido"] = $UsuApellido;
            $_SESSION["UsuCorreo"] = $UsuCorreo;
            $_SESSION["UsuTelefono"] = $UsuTelefono;
            $_SESSION["Usucontra"] = $Usucontra;
    
            // Redireccionar a la vista de usuario u otra página
            header("Location: index.php?accion=vistausuario");
        }
    }

    public function loginUsuario($UsuId, $Usucontra)
    {
        $gestorUsuario = new GestorUsuario();
        $result = $gestorUsuario->loginUsuario($UsuId, $Usucontra);

        if ($result === false) {
            header("Location: index.php?accion=inicio&erro=1"); // Credenciales incorrectas
            exit();
        } elseif ($result === 'inactivo') {
            header("Location: index.php?accion=inicio&erro=2"); // Usuario inactivo
            exit();
        }

        $_SESSION["UsuId"] = $result[0];
        $_SESSION["UsuNombre"] = $result[1];
        $_SESSION["UsuApellido"] = $result[2];
        $_SESSION["UsuCorreo"] = $result[3];
        $_SESSION["UsuTelefono"] = $result[4];
        $_SESSION["Usucontra"] = $result[5];
        $_SESSION["TuId"] = $result[6];
        $_SESSION["Estado"] = $result[7];

        header("Location:index.php?accion=vistausuario");
    }



    public function olvidarContrasenaUsuario($UsuId)
    {
        $gestorUsuario = new GestorUsuario();
        $usuario = $gestorUsuario->olvidarContrasenaUsuario($UsuId);

        if ($usuario) {
            $correo = new envio_mail();
            $correo->recepcion($usuario['UsuCorreo']);
            $mensaje = "Hola " . $usuario['UsuNombre'] . ",<br><br>" .
                "Tu contraseña es: " . $usuario['Usucontra'] . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Recuperación de Contraseña", $mensaje);
            if ($correo->enviar()) {
                exit();
            } else {
                echo "Hubo un error al enviar el correo.";
            }
        } else {
            header("Location:index.php?accion=inicio&error=usuarioNoEncontrado");
            exit();
        }
        header("Location:index.php?accion=inicio");
    }
}
