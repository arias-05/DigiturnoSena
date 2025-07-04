<?php

class Administrador
{
    private $AdminId;
    private $AdminNom;
    private $AdminApel;
    private $AdminTel;
    private $AdminCorreo;
    private $AdminContra;
    
    public function __construct($adminId, $adminNom, $adminApel, $adminTel, $adminCor,$adminCont){
        $this->AdminId = $adminId;
        $this->AdminNom = $adminNom;  
        $this->AdminApel = $adminApel;      
        $this->AdminTel = $adminTel;
        $this->AdminCorreo = $adminCor;
        $this->AdminContra = $adminCont;
    }
    
    public function obtenerDocumento()
    {
        return $this->AdminId;
    }
    public function obtenerNombre()
    {
        return $this->AdminNom;
    }
    public function obtenerApellido()
    {
        return $this->AdminApel;
    }
    public function obtenerCorreo()
    {
        return $this->AdminCorreo;
    }
    public function obtenerTelefono()
    {
        return $this->AdminTel;
    }
    public function obtenerContrasena()
    {
        return $this->AdminContra;
    }
}
