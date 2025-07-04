<?php
class TipoFuncionario
{
    
    private $TipoFuncionario;
    
    public function __construct($tipofncio){

        $this->TipoFuncionario = $tipofncio;
    }



    public function obtenerTuDetalle(){
        return $this->TipoFuncionario;
    }

}