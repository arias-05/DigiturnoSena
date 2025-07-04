<?php
class ControladorFuncionario
{
    public function logoutFun()
    {
        if (isset($_SESSION["FunId"])) {
            unset($_SESSION["FunId"]);
        }
        header("Location:index.php?accion=inicio");
        session_destroy();
    }


    public function agregarTipoFuncionario()
    {
        $gestorTipoFuncionario = new GestorTipoFuncionario();
        $result = $gestorTipoFuncionario->consultarTablaTipoFuncionario();
        require_once 'Vista/html/tablafuncionarios.php';
    }

    public function RegistrarFuncionario($funid, $funnom, $funapellido, $funtel, $funcor, $funesta, $esta, $tipfunid)
    {
        $funcionario = new Funcionario($funid, $funnom, $funapellido, $funtel, $funcor, $funesta, $esta, $tipfunid);
        $gestorFuncionario = new GestorFuncionario();
        $gestorFuncionario->RegistrarFuncionario($funcionario);
        header("Location:index.php?accion=tablafuncionarios");
    }

    public function consultarTablaFuncionario($codigo)
    {
        $gestorFuncionario = new GestorFuncionario();
        $result = $gestorFuncionario->consultarTablaFuncionarios($codigo);
        require_once 'Vista/html/consultartablafuncionarios.php';
    }
    public function cambiarEstadoCuentaFuncionario($numero, $nuevoEstado)
    {
        $gestorFuncionario = new GestorFuncionario();
        $resultado = $gestorFuncionario->cambiarEstadoCuentaFuncionario($numero, $nuevoEstado);

        if ($resultado) {
            echo "Cuenta " . ($nuevoEstado == 'activo' ? 'activada' : 'inactivada') . " correctamente.";
        } else {
            echo "Error al cambiar el estado de la cuenta.";
        }
    }

    public function modificarRegistroFuncionario($funcionario)
    {
        $gestorFuncionario = new GestorFuncionario();
        $result = $gestorFuncionario->modificarRegistroFuncionario($funcionario);
        $gestorTipoFuncionario = new Gestortipofuncionario();
        $result2 = $gestorTipoFuncionario->consultarTablaTipoFuncionario();
        require_once("Vista/html/modificarregistrofuncio.php");
    }

    public function actualizarFuncionario($funid, $funnom, $funapellido, $funtel, $funcor, $funesta, $esta, $tipfunid)
    {
        $funcionario = new Funcionario($funid, $funnom, $funapellido, $funtel, $funcor, $funesta, $esta, $tipfunid);
        $gestorFuncionario = new GestorFuncionario();
        $result = $gestorFuncionario->actualizarFuncionario($funcionario);
        if ($result > 0) {
            header("Location:index.php?accion=tablafuncionarios");
        } else {
            header("Location:index.php?accion=tablafuncionarios");
        }
    }

    public function loginFuncionario($FunId, $FunContrasena)
    {
        $gestorFuncionario = new GestorFuncionario();
        $result = $gestorFuncionario->loginFuncionario($FunId, $FunContrasena);

        if ($result === false) {
            header("Location: index.php?accion=inicio&error=1"); // Credenciales incorrectas
            exit();
        } elseif ($result === 'inactivo') {
            header("Location: index.php?accion=inicio&error=2"); // Usuario inactivo
            exit();
        }

        $_SESSION["FunId"] = $result[0];
        $_SESSION["FunNombre"] = $result[1];
        $_SESSION["FunApellido"] = $result[2];
        $_SESSION["FunTelefono"] = $result[3];
        $_SESSION["FunCorreo"] = $result[4];
        $_SESSION["FunContrasena"] = $result[5];
        $_SESSION["TipoFunId"] = $result[6];
        $_SESSION["Estado"] = $result[6];


        header("Location:index.php?accion=vistafuncionario");
    }
    public function olvidarContrasenaFuncionario($FunId)
    {
        $gestorFuncionario = new GestorFuncionario();
        $usuario = $gestorFuncionario->olvidarContrasenaFuncionario($FunId);
        if ($usuario) {
            $correo = new envio_mail();
            $correo->recepcion($usuario['FunCorreo']);
            $mensaje = "Hola " . $usuario['FunNombre'] . ",<br><br>" .
                "Tu contraseña es: " . $usuario['FunContrasena'] . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Recuperación de Contraseña", $mensaje);
            if ($correo->enviar()) {
                exit();
            } else {
                echo "Hubo un error al enviar el correo.";
            }
        } else {
            header("Location:index.php?accion=inicio&error=FuncionarioNoEncontrado");
            exit();
        }
        header("Location:index.php?accion=inicio");
    }

    public function actualizarPerfilFuncionario($FunId, $FunNombre, $FunApellido, $FunTelefono, $FunCorreo, $FunContrasena, $Estado, $TipoFunId)
    {
        $funcionario = new Funcionario($FunId, $FunNombre, $FunApellido, $FunTelefono, $FunCorreo, $FunContrasena, $Estado, $TipoFunId);
        $gestorFuncionario = new GestorFuncionario();
        $resultado = $gestorFuncionario->actualizarPerfilFuncionario($funcionario);
    
        if ($resultado > 0) {
            // Actualizar datos en la sesión
            $_SESSION["FunNombre"] = $FunNombre;
            $_SESSION["FunApellido"] = $FunApellido;
            $_SESSION["FunTelefono"] = $FunTelefono;
            $_SESSION["FunCorreo"] = $FunCorreo;
            $_SESSION["FunContrasena"] = $FunContrasena;
    
            // Redireccionar a la vista de usuario u otra página
            header("Location: index.php?accion=vistausuario");
        }
    }
}
