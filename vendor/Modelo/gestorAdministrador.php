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
                $filas["AdminContra"]
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
}