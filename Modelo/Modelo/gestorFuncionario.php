<?php
require_once 'Conexion.php';

class GestorFuncionario
{
    public function RegistrarFuncionario(Funcionario $Funcionarios)
    {
        $conexion = new Conexion();

        $FunId = $Funcionarios->obtenerDocumento();
        $FunNombre = $Funcionarios->obtenerNombre();
        $FunApellido = $Funcionarios->obtenerApellido();
        $FunTelefono = $Funcionarios->obtenerTelefono();
        $FunCorreo = $Funcionarios->obtenerCorreo();
        $FunContrasena = $Funcionarios->obtenerContrasena();
        $Estado = $Funcionarios->obtenerEstado();
        $TipoFunId = $Funcionarios->obtenerTipoFunId();

        // Consulta para verificar si el correo ya está registrado
        $sql = "SELECT FunCorreo FROM funcionarios WHERE FunCorreo = '$FunCorreo'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_filas();

        $sql2 = "SELECT FunId FROM funcionarios WHERE FunId = '$FunId'";
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
            echo "<script>$('#RegistrarFuncionario').modal('show');</script>";

            header("Location: index.php?accion=tablafuncionarios&alert_message=" . urlencode($alert_message));
            exit();
        } else {
            // Si el correo no está registrado, proceder con la inserción del nuevo usuario

            $sql = "INSERT INTO funcionarios (FunId, FunNombre, FunApellido, FunTelefono, FunCorreo, FunContrasena, Estado, TipoFunId)
                VALUES ('$FunId', '$FunNombre', '$FunApellido', '$FunTelefono', '$FunCorreo', '$FunContrasena','$Estado', $TipoFunId)";
            $conexion->ejecutar_query($sql);
            $correo = new envio_mail();
            $correo->recepcion($FunCorreo); // Enviamos el correo a la dirección del usuario
            $mensaje = "Hola " . $FunNombre . ",<br><br>" .
                "¡Nos complace informarte que tu registro en nuestra plataforma DIGITURNO ha sido exitoso!<br><br>" .
                "Gracias por unirte a nuestra comunidad.<br><br>" .
                "Datos del Registro:<br><br>" .
                "Nombre de Usuario: " . $FunNombre . " " . $FunApellido . "<br>" .
                "Correo Electrónico: " . $FunCorreo . "<br>" .
                "Documento: " . $FunId . "<br><br>" .
                "Saludos cordiales,<br>" .
                "El equipo de DIGITURNO";
            $correo->mensaje("Registro exitoso", $mensaje); // Ajustamos la llamada al método mensaje
            $correo->enviar();
        }
    }


    public function consultartablafuncionario()
    {
        $conexion = new Conexion();
        $sql = "SELECT f.*, t.TipoFncionario 
                FROM funcionarios f 
                JOIN tipofuncionario t ON f.TipoFunId = t.TipoFunId 
                WHERE f.Estado = 'Activo'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }
    
    public function consultarTablaFuncionarios($codigo)
    {
        $codigo = $codigo;
        $conexion = new Conexion();
        $sql = "
        SELECT f.*, t.TipoFncionario
        FROM funcionarios f
        JOIN tipofuncionario t ON f.TipoFunId = t.TipoFunId
        WHERE f.FunId LIKE '%$codigo%'
        OR f.FunNombre LIKE '%$codigo%'
        OR f.FunApellido LIKE '%$codigo%'
        OR f.FunTelefono LIKE '%$codigo%'
        OR f.FunCorreo LIKE '%$codigo%'
        OR f.TipoFunId LIKE '%$codigo%'
        OR f.Estado LIKE '%$codigo%'
    ";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function cambiarEstadoCuentaFuncionario($id, $nuevoEstado)
    {
        $conexion = new Conexion();
        $sql = "UPDATE funcionarios SET Estado = :nuevoEstado WHERE FunId = :FunId";
        $params = array(':nuevoEstado' => $nuevoEstado, ':FunId' => $id);
        return $conexion->ejecutar_query_preparado($sql, $params);
    }


    public function modificarRegistroFuncionario($FunId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM funcionarios WHERE FunId = $FunId";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }
    public function actualizarFuncionario(funcionario $Funcionarios)
    {
        $conexion = new Conexion();
        $FunId = $Funcionarios->obtenerDocumento();
        $FunNombre = $Funcionarios->obtenerNombre();
        $FunApellido = $Funcionarios->obtenerApellido();
        $FunTelefono = $Funcionarios->obtenerTelefono();
        $FunCorreo = $Funcionarios->obtenerCorreo();
        $FunContrasena = $Funcionarios->obtenerContrasena();
        $Estado = $Funcionarios->obtenerEstado();
        $TipoFunId = $Funcionarios->obtenerTipoFunId();

        $sql = "UPDATE funcionarios SET
        FunNombre = '$FunNombre',
        FunApellido = '$FunApellido',
        FunTelefono = $FunTelefono,
        FunCorreo = '$FunCorreo',
        FunContrasena = '$FunContrasena',
        Estado = '$Estado',
        TipoFunId = $TipoFunId 
        WHERE FunId = $FunId";

        /* $params = array(
            ':FunNombre' => $FunNombre,
            ':FunApellido' => $FunApellido,
            ':FunTelefono' => $FunTelefono,
            ':FunCorreo' => $FunCorreo,
            ':FunContraseña'=> $FunContraseña,
            ':Estado' => $Estado,
            ':TipoFunId' => $TipoFunId,
            ':FunId' => $FunId
        );*/
        $result = $conexion->ejecutar_query($sql);

        return $result;
    }
    public function loginFuncionario($FunId, $FunContrasena)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM funcionarios WHERE FunId = '$FunId' AND FunContrasena = '$FunContrasena'";
        $conexion->buscar_query($sql);
        $existe = $conexion->obtener_filas();

        if ($existe > 0) {
            $result = $conexion->obtener_resultado();
            $filas = $result->fetch(PDO::FETCH_ASSOC);
            if ($filas['Estado'] === 'Inactivo') {
                return 'inactivo'; // Funcionario inactivo
            }

            $datos = [
                $filas["FunId"],
                $filas["FunNombre"],
                $filas["FunApellido"],
                $filas["FunTelefono"],
                $filas["FunCorreo"],
                $filas["FunContrasena"],
                $filas["TipoFunId"],
                $filas["Estado"]

            ];

            return $datos;
        } else {
            return false; // Credenciales incorrectas
        }
    }

    public function olvidarContrasenaFuncionario($FunId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    }

    public function actualizarPerfilFuncionario(funcionario $Funcionarios)
    {
        $conexion = new Conexion();
        $FunId = $Funcionarios->obtenerDocumento();
        $FunNombre = $Funcionarios->obtenerNombre();
        $FunApellido = $Funcionarios->obtenerApellido();
        $FunTelefono = $Funcionarios->obtenerTelefono();
        $FunCorreo = $Funcionarios->obtenerCorreo();
        $FunContrasena = $Funcionarios->obtenerContrasena();
        $Estado = $Funcionarios->obtenerEstado();
        $TipoFunId = $Funcionarios->obtenerTipoFunId();

        $sql = "UPDATE funcionarios SET
        FunNombre = '$FunNombre',
        FunApellido = '$FunApellido',
        FunTelefono = $FunTelefono,
        FunCorreo = '$FunCorreo',
        FunContrasena = '$FunContrasena',
        Estado = '$Estado',
        TipoFunId = $TipoFunId 
        WHERE FunId = $FunId";

        $params = array(
            ':FunNombre' => $FunNombre,
            ':FunApellido' => $FunApellido,
            ':FunTelefono' => $FunTelefono,
            ':FunCorreo' => $FunCorreo,
            ':FunContrasena' => $FunContrasena,
            ':Estado' => $Estado,
            ':TipoFunId' => $TipoFunId,
            ':FunId' => $FunId
        );

        return $conexion->ejecutar_query_preparado($sql, $params);
    }
}
