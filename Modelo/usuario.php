<?php
class Usuario
{
    private $UsuId;
    private $UsuNombre;
    private $UsuApellido;
    private $UsuCorreo;
    private $UsuTelefono;
    private $UsuContra;
    private $Estado;
    private $TuId;

    public function __construct($usuid, $usunom, $usuapell, $usucor, $usutel, $usucon, $estado, $tuId)
    {
        $this->UsuId = $usuid;
        $this->UsuNombre = $usunom;
        $this->UsuApellido = $usuapell;
        $this->UsuCorreo = $usucor;
        $this->UsuTelefono = $usutel;
        $this->UsuContra = $usucon;
        $this->Estado = $estado;
        $this->TuId = $tuId;
    }

    public function obtenerDocumento()
    {
        return $this->UsuId;
    }

    public function obtenerNombre()
    {
        return $this->UsuNombre;
    }

    public function obtenerApellido()
    {
        return $this->UsuApellido;
    }

    public function obtenerCorreo()
    {
        return $this->UsuCorreo;
    }

    public function obtenerTelefono()
    {
        return $this->UsuTelefono;
    }

    public function obtenerContrasena()
    {
        return $this->UsuContra;
    }

    public function obtenerEstado()
    {
        return $this->Estado;
    }

    public function obtenerTuId()
    {
        return $this->TuId;
    }
}
