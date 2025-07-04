<?php

require_once 'Conexion.php';

class GestorTipoFuncionario
{
    public function consultarTablaTipoFuncionarios($codigo){
        $codigo= $codigo;
        $conexion = new Conexion();
        $sql= "SELECT * FROM tipofuncionario WHERE  TipoFncionario LIKE '%$codigo%'";
        $conexion->buscar_query($sql);
        $result=$conexion->obtener_resultado();
        return $result;
    }
    

    public function consultarTablaTipoFuncionario(){
        $conexion = new Conexion();
        $sql= "SELECT * FROM tipofuncionario";
        $conexion->buscar_query($sql);
        $result=$conexion->obtener_resultado();
        return $result;
    }

    

    public function insertarTipoFuncionario(tipoFuncionario $tipoFuncionario){
        $conexion = new Conexion();
        $tudetalle = $tipoFuncionario->obtenerTuDetalle();
        $sql1 = "INSERT INTO tipofuncionario VALUES ('','$tudetalle')";
        $conexion->ejecutar_query($sql1);
        
    }
    
    public function modificarTipoFuncionarios($TipoFunId)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM tipofuncionario WHERE TipoFunId = $TipoFunId";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }
    public function actualizarTipoFuncinario($id, $nom){
        $conexion = new Conexion();
        $sql = "UPDATE tipofuncionario SET TipoFncionario = :nom  WHERE TipoFunId = :id ";
        $params = array(
            ':nom' => $nom,
            ':id' => $id
        );
    
        $result = $conexion->ejecutar_query_preparado($sql, $params);
    
        return $result;
    }
    
}