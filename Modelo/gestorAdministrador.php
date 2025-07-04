<?php
require_once 'Conexion.php';

class GestorAdministrador
{
    public function loginAdministrador($AdminId, $AdminContra)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM administrador WHERE AdminId = '$AdminId' AND AdminContra = '$AdminContra'";
        $conexion->buscar_query($sql);
        $existe = $conexion->obtener_filas();

        if ($existe > 0) {
            $result = $conexion->obtener_resultado();
            $filas = $result->fetch(PDO::FETCH_ASSOC);
            if ($filas['Estado'] === 'Inactivo') {
                return 'inactivo';
            }
            $datos = [
                $filas["AdminId"], 
                $filas["AdminNom"], 
                $filas["AdminApel"], 
                $filas["AdminTel"], 
                $filas["AdminCorreo"], 
                $filas["AdminContra"],
                $filas["Estado"]


            ];
            return $datos;
        } else {
            return false;
        }
    }

    public function olvidarContrasenaAdministrador($AdminId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM Administrador WHERE AdminId = '$AdminId'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return $resultado;
        } else {
            return null;
        }
    
    }
    public function registraradmin(Administrador $administrador)
{
    $conexion = new Conexion();

    $AdminId = $administrador->obtenerDocumento();
    $AdminNom = $administrador->obtenerNombre();
    $AdminApel = $administrador->obtenerApellido();
    $AdminTel = $administrador->obtenerTelefono();
    $AdminCorreo = $administrador->obtenerCorreo();
    $AdminContra = $administrador->obtenerContrasena();
    $Estado = $administrador->obtenerEstado();

    // Consulta para verificar si el correo ya está registrado
    $sqlCorreo = "SELECT AdminCorreo FROM administrador WHERE AdminCorreo = '$AdminCorreo'";
    $conexion->buscar_query($sqlCorreo);
    $resultCorreo = $conexion->obtener_filas();

    // Consulta para verificar si el AdminId ya está registrado
    $sqlAdminId = "SELECT AdminId FROM administrador WHERE AdminId = '$AdminId'";
    $conexion->buscar_query($sqlAdminId);
    $resultAdminId = $conexion->obtener_filas();

    if ($resultCorreo > 0) {
        // El correo electrónico ya está registrado, muestra el mensaje de alerta
        $alert_message = 'El correo electrónico ya está en uso. Por favor, utiliza otro correo electrónico.';
        header("Location: index.php?accion=tablaadministrador&alert_message=" . urlencode($alert_message));
        exit();
    }

    if ($resultAdminId > 0) {
        // El número de documento ya está registrado, muestra el mensaje de alerta
        $alert_message = 'El número de documento ya está en uso. Por favor, utiliza otro número de documento.';
        header("Location: index.php?accion=tablaadministrador&alert_message=" . urlencode($alert_message));
        exit();
    }

    // Si no hay duplicados, procede con la inserción del nuevo usuario
    $sqlInsert = "INSERT INTO administrador (AdminId, AdminNom, AdminApel, AdminTel, AdminCorreo, AdminContra, Estado) 
                  VALUES ('$AdminId', '$AdminNom', '$AdminApel', '$AdminTel', '$AdminCorreo', '$AdminContra', '$Estado')";
    $conexion->ejecutar_query($sqlInsert);
    
    // Envío de correo y redirección después de la inserción exitosa
    $correo = new envio_mail();
    $correo->recepcion($AdminCorreo); // Enviamos el correo a la dirección del usuario
    $mensaje = "Hola " . $AdminNom . ",<br><br>" .
               "¡Nos complace informarte que tu registro en nuestra plataforma DIGITURNO ha sido exitoso!<br><br>" .
               "Gracias por unirte a nuestra comunidad.<br><br>" .
               "Datos del Registro:<br><br>" .
               "Nombre de Usuario: " . $AdminNom . " " . $AdminApel . "<br>" .
               "Correo Electrónico: " . $AdminCorreo . "<br>" .
               "Documento: " . $AdminId . "<br><br>" .
               "Saludos cordiales,<br>" .
               "El equipo de DIGITURNO";
    $correo->mensaje("Registro exitoso", $mensaje); // Ajustamos la llamada al método mensaje
    $correo->enviar();

    header("Location: index.php?accion=tablaadministrador");
    exit();
}


    public function consultartablaadmin($codigo, $pagina = 1, $porPagina = 2)
    {
        $codigo = $codigo;
        $conexion = new Conexion;

        $inicio = ($pagina - 1) * $porPagina;

        $sql = "SELECT * FROM administrador WHERE AdminId LIKE '%$codigo%' LIMIT $inicio, $porPagina";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function contarAdministradores($codigo)
    {
        $codigo = $codigo;
        $conexion = new Conexion;

        $sql = "SELECT COUNT(*) as total FROM administrador WHERE AdminId LIKE '%$codigo%'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        
        // Obtener el resultado correctamente
        $total = $result->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }


    

    public function cambiarEstadoCuentaAdmin($id, $nuevoEstado)
    {
        $conexion = new Conexion();
        $sql = "UPDATE administrador SET Estado = :nuevoEstado WHERE AdminId = :AdminId";
        $params = array(':nuevoEstado' => $nuevoEstado, ':AdminId' => $id);
        return $conexion->ejecutar_query_preparado($sql, $params);
    }

    public function actualizarPerfilAdmin(Administrador $administrador)
{
    $conexion = new Conexion();

    $AdminId = $administrador->obtenerDocumento();
    $AdminNom = $administrador->obtenerNombre();
    $AdminApel = $administrador->obtenerApellido();
    $AdminTel = $administrador->obtenerTelefono();
    $AdminCorreo = $administrador->obtenerCorreo();
    $AdminContra = $administrador->obtenerContrasena();
    $Estado = $administrador->obtenerEstado();

    $sql = "UPDATE administrador SET 
        AdminNom = :AdminNom,
        AdminApel = :AdminApel,
        AdminTel = :AdminTel,
        AdminCorreo = :AdminCorreo,
        AdminContra = :AdminContra,
        Estado = :Estado
        WHERE AdminId = :AdminId";

    $params = array(
        ':AdminNom' => $AdminNom,
        ':AdminApel' => $AdminApel,
        ':AdminTel' => $AdminTel,
        ':AdminCorreo' => $AdminCorreo,
        ':AdminContra' => $AdminContra,
        ':Estado' => $Estado,
        ':AdminId' => $AdminId
    );

    return $conexion->ejecutar_query_preparado($sql, $params);
}

}