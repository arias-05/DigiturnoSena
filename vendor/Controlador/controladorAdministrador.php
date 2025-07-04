<?php

class ControladorAdministrador
{
    public function logoutAdmin(){
		if (isset($_SESSION["AdminId"])) {
			unset($_SESSION["AdminId"]);
		}
        header("Location:index.php?accion=inicio");
		session_destroy(); 
	}
    public function loginAdministrador($AdminId, $AdminContra)
    {
        $gestorAdministrador = new GestorAdministrador();
        $result = $gestorAdministrador->loginAdministrador($AdminId, $AdminContra);
    
        if ($result === false) {
            header("Location: index.php?accion=inicio&err=1");
            exit();
        } elseif ($result === 'inactivo') {
            header("Location: index.php?accion=inicio&err=2"); // Usuario inactivo
            exit();
        }
    
        $_SESSION["AdminId"] = $result[0];
        $_SESSION["AdminNom"] = $result[1];
        $_SESSION["AdminApel"] = $result[2];
        $_SESSION["AdminTel"] = $result[3];
        $_SESSION["AdminCorreo"] = $result[4];
        $_SESSION["AdminContra"] = $result[5];    
        header("Location:index.php?accion=tablaregistros");
    }
    public function olvidarContrasenaAdministrador($AdminId)
    {
        $gestorAdministrador = new GestorAdministrador();
        $usuario = $gestorAdministrador->olvidarContrasenaAdministrador($AdminId);
        if ($usuario) {
            $correo = new envio_mail();
            $correo->recepcion($usuario['AdminCorreo']);
            $mensaje = "Hola " . $usuario['AdminNom'] . ",<br><br>" .
                "Tu contraseña es: " . $usuario['AdminContra'] . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Recuperación de Contraseña", $mensaje);
            if ($correo->enviar()) {
                exit();
            } else {
                echo "Hubo un error al enviar el correo.";
            }
        } else {
            header("Location:index.php?accion=inicio&error=AdminNoEncontrado");
            exit();
        }
        header("Location:index.php?accion=inicio");
        }
}