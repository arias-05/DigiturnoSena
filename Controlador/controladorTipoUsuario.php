<?php
class Controladortipousuario
{
    public function insertarTipoUsuario($tudetalle)
    {
        $tipoUsuario = new TipoUsuario($tudetalle);
        $gestorTipoUsuario = new GestorTipoUsuario($tipoUsuario);
        $gestorTipoUsuario->insertarTipoUsuario($tipoUsuario);
        header("Location:index.php?accion=tablatipousuario");
    }

    public function consultarTablaTipoUsuario($codigo)
    {
        $gestorTipoUsuario = new GestorTipoUsuario();
        $result = $gestorTipoUsuario->consultarTablaTipoUsuario($codigo);
        require_once 'Vista/html/consultartablatipousu.php';
    }


    public function modificarTipoUsuario($TuId)
    {
        $gestorTipoUsuario = new GestorTipoUsuario();
        $result = $gestorTipoUsuario->modificarTipoUsuario($TuId);
        require_once("Vista/html/modificartipousu.php");
    }

    public function actualizarTipoUsuario($id,$nom)
    {
    $gestorTipoUsuario = new GestorTipoUsuario();
    $result = $gestorTipoUsuario->actualizarTipoUsuario($id,$nom);
    if ($result >0 ){
    header("Location:index.php?accion=tablatipousuario");
    }
    else{
        header("Location:index.php?accion=tablatipousuario");}

}
}