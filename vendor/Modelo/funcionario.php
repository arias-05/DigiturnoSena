<?php

class Funcionario
{
    private $FunId;
    private $FunNombre;
    private $FunApellido;
    private $FunTelefono;
    private $FunCorreo;
    private $FunContrasena;
    private $Estado;
    private $TipoFunId;
  
    
    public function __construct($funid, $funnom, $funapellido, $funtel, $funcor,$funesta,$esta,$tipfunid){
        $this->FunId = $funid;
        $this->FunNombre = $funnom;  
        $this->FunApellido = $funapellido;      
        $this->FunTelefono = $funtel;
        $this->FunCorreo = $funcor;
        $this->FunContrasena = $funesta;
        $this->Estado = $esta;
        $this->TipoFunId = $tipfunid; 
    }
    
    public function obtenerDocumento()
    {
        return $this->FunId;
    }

    public function obtenerNombre()
    {
        return $this->FunNombre;
    }
    public function obtenerApellido()
    {
        return $this->FunApellido;
    }


    public function obtenerCorreo()
    {
        return $this->FunCorreo;
    }

    public function obtenerTelefono()
    {
        return $this->FunTelefono;
    }
    public function obtenerContrasena()
    {
        return $this->FunContrasena;
    }

    public function obtenerTipoFunId(){
        return $this->TipoFunId;
    }

    public function obtenerEstado(){
        return $this->Estado;
    }
    
}
