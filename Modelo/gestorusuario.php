<?php


require_once 'Conexion.php';

class GestorUsuario
{

    public function consultarTablaUsuario($codigo, $pagina = 1, $porPagina = 3)
{
    $codigo = $codigo;
    $conexion = new Conexion();

    // Combina la consulta de unión con la consulta de filtro
    $sql = "
        SELECT u.*, t.TuDetalle
        FROM usuario u
        JOIN tipousuario t ON u.TuId = t.TuId
        WHERE u.UsuId LIKE '%$codigo%'
        OR u.UsuNombre LIKE '%$codigo%'
        OR u.UsuApellido LIKE '%$codigo%'
        LIMIT " . (($pagina - 1) * $porPagina) . ", $porPagina
    ";

    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
}

public function contarUsuarios($codigo)
{
    $conexion = new Conexion();
    $sql = "
        SELECT COUNT(*) AS total
        FROM usuario u
        JOIN tipousuario t ON u.TuId = t.TuId
        WHERE u.UsuId LIKE '%$codigo%'
        OR u.UsuNombre LIKE '%$codigo%'
        OR u.UsuApellido LIKE '%$codigo%'
    ";
    $conexion->buscar_query($sql);
    $resultado = $conexion->obtener_resultado();

    if ($resultado) {
        $row = $resultado->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    } else {
        return 0;
    }
}


    public function registrarUsuario(Usuario $usuario)
    {
        $conexion = new Conexion();

        $UsuId = $usuario->obtenerDocumento();
        $UsuNombre = $usuario->obtenerNombre();
        $UsuApellido = $usuario->obtenerApellido();
        $UsuCorreo = $usuario->obtenerCorreo();
        $UsuTelefono = $usuario->obtenerTelefono();
        $Usucontra = $usuario->obtenerContrasena();
        $Estado = $usuario->obtenerEstado();
        $TuId = $usuario->obtenerTuId();

        // Consulta para verificar si el correo ya está registrado
        $sql = "SELECT UsuCorreo FROM usuario WHERE UsuCorreo = '$UsuCorreo'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_filas();

        $sql2 = "SELECT UsuId FROM usuario WHERE UsuId = '$UsuId'";
        $conexion->buscar_query($sql2);
        $result2 = $conexion->obtener_filas();

        if ($result > 0 || $result2 > 0) {
            if ($result > 0) {
                // El correo electrónico ya está registrado, almacena el mensaje de alerta
                $alert_message = 'El correo electrónico ya está en uso. Por favor, utiliza otro correo electrónico.';
            }
            if ($result2 > 0) {
                // El número de documento ya está registrado, almacena el mensaje de alerta
                $alert_message = 'El número de documento ya está en uso. Por favor, utiliza otro número de documento.';
            }

            // Envía la señal para abrir la modal
            echo "<script>$('#RegistrarUsuario').modal('show');</script>";

            header("Location: index.php?accion=tablaregistros&alert_message=" . urlencode($alert_message));
            exit();
        } else {
            // Si el correo no está registrado, proceder con la inserción del nuevo usuario
            $sql = "INSERT INTO usuario (UsuId, UsuNombre, UsuApellido, UsuCorreo, UsuTelefono, Usucontra, Estado, TuId) 
            VALUES ('$UsuId', '$UsuNombre', '$UsuApellido', '$UsuCorreo', '$UsuTelefono', '$Usucontra', '$Estado', '$TuId')";
            $conexion->ejecutar_query($sql);
            $correo = new envio_mail();
            $correo->recepcion($UsuCorreo); // Enviamos el correo a la dirección del usuario
            $mensaje = "Hola " . $UsuNombre . ",<br><br>" .
                "¡Nos complace informarte que tu registro en nuestra plataforma DIGITURNO ha sido exitoso!<br><br>" .
                "Gracias por unirte a nuestra comunidad.<br><br>" .
                "Datos del Registro:<br><br>" .
                "Nombre de Usuario: " . $UsuNombre . " " . $UsuApellido . "<br>" .
                "Correo Electrónico: " . $UsuCorreo . "<br>" .
                "Documento: " . $UsuId . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Registro exitoso", $mensaje); // Ajustamos la llamada al método mensaje
            $correo->enviar();
        }
    }
    public function registrarUsuarios(Usuario $usuario)
    {
        $conexion = new Conexion();

        $UsuId = $usuario->obtenerDocumento();
        $UsuNombre = $usuario->obtenerNombre();
        $UsuApellido = $usuario->obtenerApellido();
        $UsuCorreo = $usuario->obtenerCorreo();
        $UsuTelefono = $usuario->obtenerTelefono();
        $Usucontra = $usuario->obtenerContrasena();
        $Estado = $usuario->obtenerEstado();
        $TuId = $usuario->obtenerTuId();

        // Consulta para verificar si el correo ya está registrado
        $sql = "SELECT UsuCorreo FROM usuario WHERE UsuCorreo = '$UsuCorreo'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_filas();

        $sql2 = "SELECT UsuId FROM usuario WHERE UsuId = '$UsuId'";
        $conexion->buscar_query($sql2);
        $result2 = $conexion->obtener_filas();

        if ($result > 0 || $result2 > 0) {
            if ($result > 0) {
                // El correo electrónico ya está registrado, almacena el mensaje de alerta
                $alert_message = 'El correo electrónico ya está en uso. Por favor, utiliza otro correo electrónico.';
            }
            if ($result2 > 0) {
                // El número de documento ya está registrado, almacena el mensaje de alerta
                $alert_message = 'El número de documento ya está en uso. Por favor, utiliza otro número de documento.';
            }

            // Envía la señal para abrir la modal
            echo "<script>$('#RegistrarUsuario').modal('show');</script>";

            header("Location: index.php?accion=inicio&alert_message=" . urlencode($alert_message));
            exit();
        } else {
            // Si el correo no está registrado, proceder con la inserción del nuevo usuario
            $sql = "INSERT INTO usuario (UsuId, UsuNombre, UsuApellido, UsuCorreo, UsuTelefono, Usucontra, Estado, TuId) 
            VALUES ('$UsuId', '$UsuNombre', '$UsuApellido', '$UsuCorreo', '$UsuTelefono', '$Usucontra', '$Estado', '$TuId')";
            $conexion->ejecutar_query($sql);
            $correo = new envio_mail();
            $correo->recepcion($UsuCorreo); // Enviamos el correo a la dirección del usuario
            $mensaje = "Hola " . $UsuNombre . ",<br><br>" .
                "¡Nos complace informarte que tu registro en nuestra plataforma DIGITURNO ha sido exitoso!<br><br>" .
                "Gracias por unirte a nuestra comunidad.<br><br>" .
                "Datos del Registro:<br><br>" .
                "Nombre de Usuario: " . $UsuNombre . " " . $UsuApellido . "<br>" .
                "Correo Electrónico: " . $UsuCorreo . "<br>" .
                "Documento: " . $UsuId . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Registro exitoso", $mensaje); // Ajustamos la llamada al método mensaje
            $correo->enviar();
        }
    }

    public function cambiarEstadoCuenta($id, $nuevoEstado)
    {
        $conexion = new Conexion();
        $sql = "UPDATE usuario SET Estado = :nuevoEstado WHERE UsuId = :UsuId";
        $params = array(':nuevoEstado' => $nuevoEstado, ':UsuId' => $id);
        return $conexion->ejecutar_query_preparado($sql, $params);
    }

    public function modificarUsuario($UsuId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario WHERE UsuId = $UsuId";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarUsuario(Usuario $usuario)
    {
        $conexion = new Conexion();

        $UsuId = $usuario->obtenerDocumento();
        $UsuNombre = $usuario->obtenerNombre();
        $UsuApellido = $usuario->obtenerApellido();
        $UsuCorreo = $usuario->obtenerCorreo();
        $UsuTelefono = $usuario->obtenerTelefono();
        $Usucontra = $usuario->obtenerContrasena();
        $Estado = $usuario->obtenerEstado();
        $TuId = $usuario->obtenerTuId();

        $sql = "UPDATE usuario SET 
        UsuNombre = :UsuNombre,
        UsuApellido = :UsuApellido,
        UsuCorreo = :UsuCorreo,
        UsuTelefono = :UsuTelefono,
        Usucontra = :Usucontra,
        Estado = :Estado,
        TuId = :TuId
        WHERE UsuId = :UsuId";

        $params = array(
            ':UsuNombre' => $UsuNombre,
            ':UsuApellido' => $UsuApellido,
            ':UsuCorreo' => $UsuCorreo,
            ':UsuTelefono' => $UsuTelefono,
            ':Usucontra' => $Usucontra,
            ':Estado' => $Estado,
            ':TuId' => $TuId,
            ':UsuId' => $UsuId
        );

        return $conexion->ejecutar_query_preparado($sql, $params);
    }

    public function actualizarPerfil(Usuario $usuario)
    {
        $conexion = new Conexion();

        $UsuId = $usuario->obtenerDocumento();
        $UsuNombre = $usuario->obtenerNombre();
        $UsuApellido = $usuario->obtenerApellido();
        $UsuCorreo = $usuario->obtenerCorreo();
        $UsuTelefono = $usuario->obtenerTelefono();
        $Usucontra = $usuario->obtenerContrasena();
        $Estado = $usuario->obtenerEstado();
        $TuId = $usuario->obtenerTuId();

        $sql = "UPDATE usuario SET 
        UsuNombre = :UsuNombre,
        UsuApellido = :UsuApellido,
        UsuCorreo = :UsuCorreo,
        UsuTelefono = :UsuTelefono,
        Usucontra = :Usucontra,
        Estado = :Estado,
        TuId = :TuId
        WHERE UsuId = :UsuId";

        $params = array(
            ':UsuNombre' => $UsuNombre,
            ':UsuApellido' => $UsuApellido,
            ':UsuCorreo' => $UsuCorreo,
            ':UsuTelefono' => $UsuTelefono,
            ':Usucontra' => $Usucontra,
            ':Estado' => $Estado,
            ':TuId' => $TuId,
            ':UsuId' => $UsuId
        );

        return $conexion->ejecutar_query_preparado($sql, $params);
    }


    public function loginUsuario($UsuId, $Usucontra)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario WHERE UsuId = '$UsuId' AND Usucontra = '$Usucontra'";
        $conexion->buscar_query($sql);
        $existe = $conexion->obtener_filas();

        if ($existe > 0) {
            $result = $conexion->obtener_resultado();
            $filas = $result->fetch(PDO::FETCH_ASSOC);

            if ($filas['Estado'] === 'Inactiva') {
                return 'inactivo'; // Usuario inactivo
            }

            $datos = [
                $filas["UsuId"],
                $filas["UsuNombre"],
                $filas["UsuApellido"],
                $filas["UsuCorreo"],
                $filas["UsuTelefono"],
                $filas["Usucontra"],
                $filas["TuId"],
                $filas["Estado"]
            ];
            return $datos;
        } else {
            return false; // Credenciales incorrectas
        }
    }



    public function olvidarContrasenaUsuario($UsuId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }
}
