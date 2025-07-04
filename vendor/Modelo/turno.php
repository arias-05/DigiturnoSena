<?php
class Cita
{
    private $TurnoId;
    private $TurnHFSoli;
    private $TurnHAsig;
    private $TurnDetalle;
    private $TurnObserva;
    private $FunId;
    private $UsuId;
    private $TuId;
    private $Estado;

    public function __construct($turnoid, $turnhfsoli, $turnhasig, $turndetalle, $turnobserva, $funid, $usuid, $tuid, $estado)
    {
        $this->TurnoId = $turnoid;
        $this->TurnHFSoli = $turnhfsoli;
        $this->TurnHAsig = $turnhasig;
        $this->TurnDetalle = $turndetalle;
        $this->TurnObserva = $turnobserva;
        $this->FunId = $funid;
        $this->UsuId = $usuid;
        $this->TuId = $tuid;
        $this->Estado = $estado;
    }

    public function ObtenerCitaId()
    {
        return $this->TurnoId;

    }

    public function ObtenerHFSolicitada()
    {
        return $this->TurnHFSoli;
    }

    public function ObtenerHFAsignada()
    {
        return $this->TurnHAsig;;
    }

    public function ObtenerDetalle()
    {
        return $this->TurnDetalle;
    }

    public function ObtenerObservacion()
    {
        return $this->TurnObserva;
    }

    public function ObtenerFuncionario()
    {
        return $this->FunId;
    }

    public function ObtenerUsuario()
    {
        return $this->UsuId;
    }

    public function ObtenerTuId()
    {
        return $this->TuId;
    }

    public function ObtenerEstado()
    {
        return $this->Estado;
    }
}
