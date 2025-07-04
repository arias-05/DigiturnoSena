
<?php
class ControladorTipoFuncionario
{
    public function insertarTipoFuncionario($TipoFncionario){
        $tipoFuncionario = new TipoFuncionario($TipoFncionario);
        $gestorTipoFuncionario = new GestorTipoFuncionario();
        $gestorTipoFuncionario->insertarTipoFuncionario($tipoFuncionario);
        header("Location:index.php?accion=tablatipofuncionarios");
    }

    public function consultarTablaTipoFuncionario($codigo){
        $gestorTipoFuncionario = new GestorTipoFuncionario();
        $result = $gestorTipoFuncionario->consultarTablaTipoFuncionario($codigo);
        require_once 'Vista/html/consultartablatipofunc.php';
    }

    public function eliminarTipoFunId($TipoFunId){
        $gestorTipoFuncionario = new Gestortipofuncionario();
        $registros = $gestorTipoFuncionario->eliminarTipoFunId($TipoFunId);
        if($registros > 0){
            echo "El Tipo funcionario fue eliminado correctamente";
            
        } else{
           
            echo "El Tipo funcionario no fue eliminado";
        }
    }
    public function modificarTipoFuncionarios($TipoFunId)
    {
        $gestorTipoFuncionario = new Gestortipofuncionario();
        $result = $gestorTipoFuncionario->modificarTipoFuncionarios($TipoFunId);
        require_once("Vista/html/modificartipofuncionarios.php");
    }
    public function actualizarTipoFuncinario($id,$nom)
    {
    $gestorTipoFuncionario = new Gestortipofuncionario();
    $result = $gestorTipoFuncionario->actualizarTipoFuncinario($id,$nom);
    if ($result > 0 ){
    header("Location:index.php?accion=tablatipofuncionarios");
    }
    else{
        header("Location:index.php?accion=tablatipofuncionarios");}
    }

    
}
?>