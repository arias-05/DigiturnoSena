<?php
class TipoUsuario
{
    
    private $TuDetalle;
    
    public function __construct($tudetalle){

        $this->TuDetalle = $tudetalle;
    }



    public function obtenerTuDetalle(){
        return $this->TuDetalle;
    }

}
