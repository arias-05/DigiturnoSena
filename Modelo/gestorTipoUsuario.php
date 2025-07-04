<?php
require_once 'Conexion.php';

class GestorTipoUsuario
{

    public function insertarTipoUsuario(tipousuario $tipousuario)
    {
        $conexion = new Conexion();
        $tudetalle = $tipousuario->obtenerTuDetalle();
        $sql1 = "INSERT INTO tipousuario VALUES ('','$tudetalle')";
        $conexion->ejecutar_query($sql1);
    }

    public function consultarTablaTipoUsuario($codigo)
    {
        $codigo = $codigo;
        $conexion = new Conexion();
        $sql = "SELECT * FROM tipousuario WHERE TuDetalle LIKE '%$codigo%'";

        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarTablaTipoUsuarios()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM tipousuario";

        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    

    public function modificarTipoUsuario($TuId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM tipousuario WHERE TuId = $TuId";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarTipoUsuario($id, $nom){
        $conexion = new Conexion();
        $sql = "UPDATE tipousuario SET TuDetalle = :nom  WHERE TuId = :id ";
        $params = array(
            ':nom' => $nom,
            ':id' => $id
        );
    
        $result = $conexion->ejecutar_query_preparado($sql, $params);
    
        return $result;
    }
}
