<?php

class ControladorCita
{
    public function registrarcita($turnhfsoli, $turndetalle, $funid, $usuid, $tuid, $estado)
    {
        $cita = new Cita("", $turnhfsoli, "", $turndetalle, "", $funid, $usuid, $tuid, $estado);
        $gestorCita = new GestorCitas();
        $gestorCita->registrarcita($cita);
        header("Location:index.php?accion=vistausuario");
    }
    public function agregaFuncionario()
    {
        $gestorFuncionario = new GestorFuncionario();
        $result = $gestorFuncionario->consultartablafuncionario();
        require_once 'Vista/html/vistausuario.php';
    }

    public function consultartablacita($codigo)
    {
        $gestorCita = new GestorCitas();
        $result = $gestorCita->consultartablacita($codigo);
        require_once 'Vista/html/consultartablacita.php';
    }
    public function cancelarcita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado)
    {
        $cita = new Cita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado);
        $gestorCita = new GestorCitas();
        $result = $gestorCita->cancelarcita($cita);
        if ($result > 0) {
            header("Location:index.php?accion=vistausuario");
        } else {
            header("Location:index.php?accion=vistausuario");
        }
    }
    public function editarcitausu($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado)
    {
        $cita = new Cita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado);
        $gestorCita = new GestorCitas();
        $result = $gestorCita->editarcitausu($cita);
        if ($result > 0) {
            header("Location:index.php?accion=vistausuario");
        } else {
            header("Location:index.php?accion=vistausuario");
        }
    }

    public function agendarCitaFun($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado)
    {
        $cita = new Cita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado);
        $gestorCita = new GestorCitas();
        $result = $gestorCita->agendarCitaFun($cita);
        if ($result > 0) {
            header("Location:index.php?accion=vistafuncionario");
        } else {
            header("Location:index.php?accion=vistafuncionario");
        }
    }
    public function editarCitaAsignada($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado)
    {
        $cita = new Cita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado);
        $gestorCita = new GestorCitas();
        $result = $gestorCita->editarCitaAsignada($cita);
        if ($result > 0) {
            header("Location:index.php?accion=vistafuncionario");
        } else {
            header("Location:index.php?accion=vistafuncionario");
        }
    }

    public function registrocitas($FechaInicio, $FechaFin)
    {
        $gestorCitas = new GestorCitas();
        $gestorCitas->registrocitas($FechaInicio, $FechaFin);
    }

    public function registroCitasFuncionario($FechaInicio, $FechaFin)
    {
        $FunId = $_POST['FunId'];
        $gestorCitas = new GestorCitas();
        $gestorCitas->registroCitasFuncionario($FechaInicio, $FechaFin, $FunId);
    }

    public function terminarCita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado)
    {
        $cita = new Cita($turnoId, $turnHFSoli, $turnHAsig, $turnDetalle, $turnobserva, $funId, $usuId, $tuId, $estado);
        $gestorCita = new GestorCitas();
        $result = $gestorCita->terminarCita($cita);
        if ($result > 0) {
            header("Location:index.php?accion=vistafuncionario");
        } else {
            header("Location:index.php?accion=vistafuncionario");
        }
    }
}
