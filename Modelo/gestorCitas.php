<?php
require_once 'Conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GestorCitas
{
    public function registrarcita(Cita $Cita)
    {
        $TurnHFSoli = $Cita->ObtenerHFSolicitada();
        $TurnHAsig = $Cita->ObtenerHFAsignada();
        $TurnDetalle = $Cita->ObtenerDetalle();
        $TurnObserva = $Cita->ObtenerObservacion();
        $FunId = $Cita->ObtenerFuncionario();
        $UsuId = $Cita->ObtenerUsuario();
        $TuId = $Cita->ObtenerTuId();
        $Estado = $Cita->ObtenerEstado();

        $conexion = new Conexion();

        // Insertar la cita en la tabla turno
        $sql = "INSERT INTO turno VALUES ('','$TurnHFSoli', '$TurnHAsig', '$TurnDetalle', '$TurnObserva', '$FunId', '$UsuId', '$TuId', '$Estado')";
        $conexion->ejecutar_query($sql);

        // Consulta para obtener el correo y nombre del funcionario
        $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
        $conexion->buscar_query($sql2);

        if ($conexion->obtener_filas() > 0) {
            // Obtener resultados y asignar variables
            $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
            $correoFuncionario = $funcionario['FunCorreo'];
            $nombreFuncionario = $funcionario['FunNombre'];

            // Consulta para obtener el nombre del usuario
            $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
            $conexion->buscar_query($sql3);

            if ($conexion->obtener_filas() > 0) {
                $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $nombreUsuario = $usuario['UsuNombre'];

                // Envío de correo electrónico al funcionario
                $correo = new envio_mail();
                $mensaje = "Hola " . $nombreFuncionario . ",<br><br>" .
                    "¡Un usuario ha solicitado una cita contigo en la plataforma DIGITURNO!<br><br>" .
                    "Detalles de la cita:<br><br>" .
                    "Nombre del usuario: " . $nombreUsuario . "<br>" .
                    "Hora y fecha solicitada: " . $TurnHFSoli . "<br>" .
                    "Detalles: " . $TurnDetalle . "<br><br>" .
                    "Por favor, revisa y confirma la cita.<br><br>" .
                    "Saludos cordiales,<br>" .
                    "El equipo de DIGITURNO";

                $correo->recepcion($correoFuncionario);
                $correo->mensaje("Nueva Cita Asignada", $mensaje);
                $correo->enviar();

                echo "Cita registrada y correo enviado correctamente.";
            } else {
                echo "No se encontró un usuario con el ID proporcionado.";
            }
        } else {
            echo "No se encontró un funcionario con el ID proporcionado.";
        }
    }

    public function consultartablacita($codigo, $pagina = 1, $porPagina = 3)
    {
        $conexion = new Conexion();
        $inicio = ($pagina - 1) * $porPagina;

        $sql = "
            SELECT t.*, f.FunNombre, tu.TuDetalle, u.UsuNombre
            FROM turno t
            JOIN funcionarios f ON t.FunId = f.FunId
            JOIN tipousuario tu ON t.TuId = tu.TuId
            JOIN usuario u ON t.UsuId = u.UsuId 
            WHERE t.Estado LIKE '%$codigo%'
            LIMIT $inicio, $porPagina
        ";

        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }
    public function contarCitas($codigo)
    {
        $conexion = new Conexion();
        $sql = "SELECT COUNT(*) AS total FROM turno WHERE Estado LIKE '%$codigo%'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado();

        if ($resultado) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function consultartablacitausu($codigo, $pagina = 1, $porPagina = 3)
    {
        $conexion = new Conexion();
        $inicio = ($pagina - 1) * $porPagina;
        $UsuId = $_SESSION['UsuId'];


        $sql = "
            SELECT t.*, f.FunNombre, tu.TuDetalle, u.UsuNombre
            FROM turno t
            JOIN funcionarios f ON t.FunId = f.FunId
            JOIN tipousuario tu ON t.TuId = tu.TuId
            JOIN usuario u ON t.UsuId = u.UsuId 
            WHERE t.Estado LIKE '%$codigo%' AND u.UsuId = $UsuId
            LIMIT $inicio, $porPagina
        ";

        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }
    public function contarCitasusu($codigo)
    {
        $conexion = new Conexion();
        $UsuId = $_SESSION['UsuId'];


        $sql = "SELECT COUNT(*) AS total FROM turno WHERE Estado LIKE '%$codigo%' AND UsuId = $UsuId";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado();

        if ($resultado) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function consultartablacitafun($codigo, $pagina = 1, $porPagina = 3)
    {
        $conexion = new Conexion();
        $inicio = ($pagina - 1) * $porPagina;
        $funId = $_SESSION['FunId'];

        $sql = "
        SELECT t.*, f.FunNombre, tu.TuDetalle, u.UsuNombre
        FROM turno t
        JOIN funcionarios f ON t.FunId = f.FunId
        JOIN tipousuario tu ON t.TuId = tu.TuId
        JOIN usuario u ON t.UsuId = u.UsuId 
        WHERE t.Estado LIKE '%$codigo%' AND t.FunId = $funId
        LIMIT $inicio, $porPagina
    ";

        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function contarCitasfun($codigo)
    {
        $conexion = new Conexion();
        $funId = $_SESSION['FunId'];

        $sql = "SELECT COUNT(*) AS total FROM turno WHERE Estado LIKE '%$codigo%' AND FunId = $funId";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado();

        if ($resultado) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } else {
            return 0;
        }
    }



    public function cancelarcita(Cita $cita)
    {
        $conexion = new Conexion();
        $TurnoId = $cita->ObtenerCitaId();
        $TurnHFSoli = $cita->ObtenerHFSolicitada();
        $TurnHAsig = $cita->ObtenerHFAsignada();
        $TurnDetalle = $cita->ObtenerDetalle();
        $TurnObserva = $cita->ObtenerObservacion();
        $FunId = $cita->ObtenerFuncionario();
        $UsuId = $cita->ObtenerUsuario();
        $TuId = $cita->ObtenerTuId();
        $Estado = $cita->ObtenerEstado();

        // Concatenar "Cancelado:" con el estado actual
        $Estado = 'Cancelado: ' . $Estado;

        // Asegúrate de usar comillas simples para los valores de texto y escaparlos correctamente
        $sql = "UPDATE turno SET 
        TurnHFSoli = '$TurnHFSoli',
        TurnHAsig = '$TurnHAsig',
        TurnDetalle = '$TurnDetalle',
        TurnObserva = '$TurnObserva',
        FunId = '$FunId',  
        UsuId = '$UsuId',  
        TuId = '$TuId',
        Estado = '$Estado'   
        WHERE TurnoId = '$TurnoId'";

        $result = $conexion->ejecutar_query($sql);

        if ($result) {
            // Consulta para obtener el correo y nombre del funcionario
            $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
            $conexion->buscar_query($sql2);

            if ($conexion->obtener_filas() > 0) {
                // Obtener resultados y asignar variables
                $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $correoFuncionario = $funcionario['FunCorreo'];
                $nombreFuncionario = $funcionario['FunNombre'];

                // Consulta para obtener el nombre del usuario
                $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
                $conexion->buscar_query($sql3);

                if ($conexion->obtener_filas() > 0) {
                    $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                    $nombreUsuario = $usuario['UsuNombre'];

                    // Envío de correo electrónico al funcionario
                    $correo = new envio_mail();
                    $mensaje = "Hola " . $nombreFuncionario . ",<br><br>" .
                        "¡Un usuario ha cancelado una cita que ya tenías con él en la plataforma DIGITURNO!<br><br>" .
                        "Detalles de la cita:<br><br>" .
                        "Nombre del usuario: " . $nombreUsuario . "<br>" .
                        "Hora y fecha solicitada: " . $TurnHFSoli . "<br>" .
                        "Detalles: " . $TurnDetalle . "<br><br>" .
                        "Observacion: " . $TurnObserva . "<br><br>" .
                        "Motivo: " . $Estado . "<br><br>" .
                        "Motivo de porque cancela la cita: " . $Estado . "<br><br>" .
                        "Saludos cordiales,<br>" .
                        "El equipo de DIGITURNO";

                    $correo->recepcion($correoFuncionario);
                    $correo->mensaje("Cancelacion de Cita", $mensaje);
                    $correo->enviar();

                    echo "Cita editada y correo enviado correctamente.";
                } else {
                    echo "No se encontró un usuario con el ID proporcionado.";
                }
            } else {
                echo "No se encontró un funcionario con el ID proporcionado.";
            }
        } else {
            echo "Error al actualizar la cita.";
        }

        return $result;
    }



    public function editarcitausu(Cita $cita)
    {
        $conexion = new Conexion();
        $TurnoId = $cita->ObtenerCitaId();
        $nuevoDetalle = $cita->ObtenerDetalle();

        // Obtener el detalle actual de la cita
        $sql = "SELECT TurnDetalle FROM turno WHERE TurnoId = '$TurnoId'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);
        $detalleActual = $fila['TurnDetalle'];

        // Concatenar el detalle actual con el nuevo detalle
        $detalleConcatenado = $detalleActual . " añadió: " . $nuevoDetalle;

        $TurnHFSoli = $cita->ObtenerHFSolicitada();
        $TurnHAsig = $cita->ObtenerHFAsignada();
        $TurnObserva = $cita->ObtenerObservacion();
        $FunId = $cita->ObtenerFuncionario();
        $UsuId = $cita->ObtenerUsuario();
        $TuId = $cita->ObtenerTuId();
        $Estado = $cita->ObtenerEstado();

        // Actualizar la cita con el detalle concatenado
        $sql = "UPDATE turno SET 
    TurnHFSoli = '$TurnHFSoli',
    TurnHAsig = '$TurnHAsig',
    TurnDetalle = '$detalleConcatenado',
    TurnObserva = '$TurnObserva',
    FunId = '$FunId',  
    UsuId = '$UsuId',  
    TuId = '$TuId',
    Estado = '$Estado'
    WHERE TurnoId = '$TurnoId'";

        $result = $conexion->ejecutar_query($sql);

        if ($result) {
            // Consulta para obtener el correo y nombre del funcionario
            $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
            $conexion->buscar_query($sql2);

            if ($conexion->obtener_filas() > 0) {
                // Obtener resultados y asignar variables
                $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $correoFuncionario = $funcionario['FunCorreo'];
                $nombreFuncionario = $funcionario['FunNombre'];

                // Consulta para obtener el nombre del usuario
                $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
                $conexion->buscar_query($sql3);

                if ($conexion->obtener_filas() > 0) {
                    $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                    $nombreUsuario = $usuario['UsuNombre'];

                    // Envío de correo electrónico al funcionario
                    $correo = new envio_mail();
                    $mensaje = "Hola " . $nombreFuncionario . ",<br><br>" .
                        "¡Un usuario ha editado una cita que ya tenías con él en la plataforma DIGITURNO!<br><br>" .
                        "Detalles de la cita:<br><br>" .
                        "Nombre del usuario: " . $nombreUsuario . "<br>" .
                        "Hora y fecha solicitada: " . $TurnHFSoli . "<br>" .
                        "Detalles: " . $detalleConcatenado . "<br><br>" .
                        "Saludos cordiales,<br>" .
                        "El equipo de DIGITURNO";

                    $correo->recepcion($correoFuncionario);
                    $correo->mensaje("Edición de cita", $mensaje);
                    $correo->enviar();

                    echo "Cita editada y correo enviado correctamente.";
                } else {
                    echo "No se encontró un usuario con el ID proporcionado.";
                }
            } else {
                echo "No se encontró un funcionario con el ID proporcionado.";
            }
        } else {
            echo "Error al actualizar la cita.";
        }

        return $result;
    }


    public function agendarCitaFun(Cita $cita)
    {
        $conexion = new Conexion();
        $TurnoId = $cita->ObtenerCitaId();
        $TurnHFSoli = $cita->ObtenerHFSolicitada();
        $TurnHAsig = $cita->ObtenerHFAsignada();
        $TurnDetalle = $cita->ObtenerDetalle();
        $TurnObserva = $cita->ObtenerObservacion();
        $FunId = $cita->ObtenerFuncionario();
        $UsuId = $cita->ObtenerUsuario();
        $TuId = $cita->ObtenerTuId();
        $Estado = $cita->ObtenerEstado();


        $sql = "UPDATE turno SET 
        TurnHFSoli = '$TurnHFSoli',
        TurnHAsig = '$TurnHAsig',
        TurnDetalle = '$TurnDetalle',
        TurnObserva = '$TurnObserva',
        FunId = '$FunId',  
        UsuId = '$UsuId',  
        TuId = '$TuId',
        Estado = '$Estado'  
        WHERE TurnoId = '$TurnoId'";

        $result = $conexion->ejecutar_query($sql);

        if ($result) {
            // Consulta para obtener el correo y nombre del funcionario
            $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
            $conexion->buscar_query($sql2);

            if ($conexion->obtener_filas() > 0) {
                // Obtener resultados y asignar variables
                $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $nombreFuncionario = $funcionario['FunNombre'];

                $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
                $conexion->buscar_query($sql3);

                if ($conexion->obtener_filas() > 0) {
                    $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                    $nombreUsuario = $usuario['UsuNombre'];
                    $correoUsuario = $usuario['UsuCorreo'];

                    // Envío de correo electrónico al funcionario
                    $correo = new envio_mail();
                    $mensaje = "Hola " . $nombreUsuario . ",<br><br>" .
                        "¡Un Funcionario a asignado una cita que ya tenías con él en la plataforma DIGITURNO!<br><br>" .
                        "Detalles de la cita:<br><br>" .
                        "Nombre del Funcionario: " . $nombreFuncionario . "<br>" .
                        "Hora y fecha asignada: " . $TurnHAsig . "<br>" .
                        "Observacion de la cita: " . $TurnObserva . "<br><br>" .
                        "Saludos cordiales,<br>" .
                        "El equipo de DIGITURNO";

                    $correo->recepcion($correoUsuario);
                    $correo->mensaje("Agendamiento de cita", $mensaje);
                    $correo->enviar();

                    echo "Cita editada y correo enviado correctamente.";
                } else {
                    echo "No se encontró un usuario con el ID proporcionado.";
                }
            } else {
                echo "No se encontró un funcionario con el ID proporcionado.";
            }
        } else {
            echo "Error al actualizar la cita.";
        }

        return $result;
    }

    public function editarCitaAsignada(Cita $cita)
    {
        $conexion = new Conexion();
        $TurnoId = $cita->ObtenerCitaId();
        $TurnHFSoli = $cita->ObtenerHFSolicitada();
        $TurnHAsig = $cita->ObtenerHFAsignada();
        $TurnDetalle = $cita->ObtenerDetalle();
        $TurnObserva = $cita->ObtenerObservacion();
        $FunId = $cita->ObtenerFuncionario();
        $UsuId = $cita->ObtenerUsuario();
        $TuId = $cita->ObtenerTuId();
        $Estado = $cita->ObtenerEstado();

        // Obtener el detalle actual de la cita
        $sql = "SELECT TurnObserva FROM turno WHERE TurnoId = '$TurnoId'";
        $conexion->buscar_query($sql);
        $resultado = $conexion->obtener_resultado();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);
        $observacionActual = $fila['TurnObserva'];

        // Concatenar el detalle actual con el nuevo detalle
        $observacionConcatenado = $observacionActual . " añadió: " . $TurnObserva;

        // Actualizar la cita en la base de datos
        $sql = "UPDATE turno SET 
        TurnHFSoli = '$TurnHFSoli',
        TurnHAsig = '$TurnHAsig',
        TurnDetalle = '$TurnDetalle',
        TurnObserva = '$observacionConcatenado',
        FunId = '$FunId',  
        UsuId = '$UsuId',  
        TuId = '$TuId',
        Estado = '$Estado'  
        WHERE TurnoId = '$TurnoId'";

        $result = $conexion->ejecutar_query($sql);

        if ($result) {
            // Consulta para obtener el correo y nombre del funcionario
            $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
            $conexion->buscar_query($sql2);

            if ($conexion->obtener_filas() > 0) {
                // Obtener resultados y asignar variables
                $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $nombreFuncionario = $funcionario['FunNombre'];

                $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
                $conexion->buscar_query($sql3);

                if ($conexion->obtener_filas() > 0) {
                    $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                    $nombreUsuario = $usuario['UsuNombre'];
                    $correoUsuario = $usuario['UsuCorreo'];

                    // Envío de correo electrónico al usuario
                    $correo = new envio_mail();
                    $mensaje = "Hola " . $nombreUsuario . ",<br><br>" .
                        "¡Un funcionario ha editado la cita en la plataforma DIGITURNO!<br><br>" .
                        "Detalles de la cita:<br><br>" .
                        "Hora y fecha asignada: " . $TurnHAsig . "<br>" .
                        "Observación de la cita: " . $observacionConcatenado . "<br><br>" .
                        "Saludos cordiales,<br>" .
                        "El equipo de DIGITURNO";

                    $correo->recepcion($correoUsuario);
                    $correo->mensaje("Edición de cita", $mensaje);
                    $correo->enviar();

                    echo "Cita editada y correo enviado correctamente.";
                } else {
                    echo "No se encontró un usuario con el ID proporcionado.";
                }
            } else {
                echo "No se encontró un funcionario con el ID proporcionado.";
            }
        } else {
            echo "Error al actualizar la cita.";
        }

        return $result;
    }


    public function registrocitas($TurnHFSoli, $TurnHAsig)
    {
        $conexion = new Conexion(); // Reemplaza esto con tu lógica para conectar a la base de datos

        // Consulta con INNER JOIN para obtener datos de 'turno' y 'usuario'
        $sql = "SELECT t.*, u.UsuId, u.UsuNombre, u.UsuCorreo, u.UsuApellido, f.FunNombre, f.FunApellido, f.FunCorreo
        FROM turno t
        INNER JOIN usuario u ON t.UsuId = u.UsuId
        INNER JOIN funcionarios f ON t.FunId = f.FunId
        WHERE t.TurnHFSoli BETWEEN '$TurnHFSoli' AND '$TurnHAsig'";

        $conexion->buscar_query($sql);
        $stmt = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

        // Crear un nuevo libro de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados de las columnas para 'turno'
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'Hora de Solicitud');
        $sheet->setCellValue('C1', 'Hora de Asignacion');
        $sheet->setCellValue('D1', 'Detalles de la cita');
        $sheet->setCellValue('E1', 'Observacion de la Cita');
        $sheet->setCellValue('F1', 'Documento del Funcionario');
        $sheet->setCellValue('G1', 'Nombre del Funcionario');
        $sheet->setCellValue('H1', 'Apellido del Funcionario');
        $sheet->setCellValue('I1', 'Correo del Funcionario');
        $sheet->setCellValue('J1', 'Documento del Usuario');
        $sheet->setCellValue('K1', 'Nombre del Usuario');
        $sheet->setCellValue('L1', 'Apellido del Usuario');
        $sheet->setCellValue('M1', 'Correo del Usuario');
        $sheet->setCellValue('N1', 'Tipo Funcionario');
        $sheet->setCellValue('O1', 'Estado de la Cita');

        // Aplicar estilo a los encabezados (color de fondo, centrado y bordes)
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFF00'],
            ],
        ];

        $sheet->getStyle('A1:O1')->applyFromArray($headerStyle);

        // Ajustar el ancho de las columnas automáticamente
        foreach (range('A', 'O') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Procesar datos combinados de 'turno', 'usuario' y 'funcionario'
        $fila = 2;
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $sheet->setCellValue('A' . $fila, $row->TurnoId);
            $sheet->setCellValue('B' . $fila, $row->TurnHFSoli);
            $sheet->setCellValue('C' . $fila, $row->TurnHAsig);
            $sheet->setCellValue('D' . $fila, $row->TurnDetalle);
            $sheet->setCellValue('E' . $fila, $row->TurnObserva);
            $sheet->setCellValue('F' . $fila, $row->FunId);
            $sheet->setCellValue('G' . $fila, $row->FunNombre);
            $sheet->setCellValue('H' . $fila, $row->FunApellido);
            $sheet->setCellValue('I' . $fila, $row->FunCorreo);
            $sheet->setCellValue('J' . $fila, $row->UsuId);
            $sheet->setCellValue('K' . $fila, $row->UsuNombre);
            $sheet->setCellValue('L' . $fila, $row->UsuApellido); // Ajusta según la estructura real de tu base de datos
            $sheet->setCellValue('M' . $fila, $row->UsuCorreo);
            $sheet->setCellValue('N' . $fila, $row->TuId);
            $sheet->setCellValue('O' . $fila, $row->Estado);

            // Aplicar bordes a todas las celdas
            $sheet->getStyle('A' . $fila . ':O' . $fila)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $fila++;
        }

        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'lista_citas_usuarios.xlsx'; // Nombre del archivo

        // Limpiar el búfer de salida antes de enviar las cabeceras HTTP
        ob_end_clean();

        // Configurar cabeceras para la descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Leer y enviar el archivo Excel al navegador
        $writer->save('php://output');
        exit;
    }

    public function registroCitasFuncionario($FechaInicio, $FechaFin, $FunId)
    {
        $conexion = new Conexion();

        // Consulta con INNER JOIN para obtener datos de 'turno' y 'usuario'
        $sql = "SELECT t.*, u.UsuId, u.UsuNombre, u.UsuCorreo, u.UsuApellido
            FROM turno t
            INNER JOIN usuario u ON t.UsuId = u.UsuId
            WHERE t.TurnHFSoli BETWEEN '$FechaInicio' AND '$FechaFin'
            AND t.FunId = '$FunId'"; // Filtrar por FunId

        $conexion->buscar_query($sql);
        $stmt = $conexion->obtener_resultado();

        // Crear un nuevo libro de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados de las columnas para 'turno'
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'Hora de Solicitud');
        $sheet->setCellValue('C1', 'Hora de Asignacion');
        $sheet->setCellValue('D1', 'Detalles de la cita');
        $sheet->setCellValue('E1', 'Observacion de la Cita');
        $sheet->setCellValue('F1', 'Documento del Funcionario');
        $sheet->setCellValue('G1', 'Documento del Usuario');
        $sheet->setCellValue('H1', 'Nombre del Usuario');
        $sheet->setCellValue('I1', 'Apellido del Usuario');
        $sheet->setCellValue('J1', 'Correo del Usuario');
        $sheet->setCellValue('K1', 'Tipo Funcionario');
        $sheet->setCellValue('L1', 'Estado de la Cita');

        // Aplicar estilo a los encabezados
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFF00'],
            ],
        ];

        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);

        // Ajustar el ancho de las columnas automáticamente
        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Procesar datos combinados de 'turno' y 'usuario'
        $fila = 2;
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $sheet->setCellValue('A' . $fila, $row->TurnoId);
            $sheet->setCellValue('B' . $fila, $row->TurnHFSoli);
            $sheet->setCellValue('C' . $fila, $row->TurnHAsig);
            $sheet->setCellValue('D' . $fila, $row->TurnDetalle);
            $sheet->setCellValue('E' . $fila, $row->TurnObserva);
            $sheet->setCellValue('F' . $fila, $row->FunId);
            $sheet->setCellValue('G' . $fila, $row->UsuId);
            $sheet->setCellValue('H' . $fila, $row->UsuNombre);
            $sheet->setCellValue('I' . $fila, $row->UsuApellido);
            $sheet->setCellValue('J' . $fila, $row->UsuCorreo);
            $sheet->setCellValue('K' . $fila, $row->TuId);
            $sheet->setCellValue('L' . $fila, $row->Estado);

            // Aplicar bordes a todas las celdas
            $sheet->getStyle('A' . $fila . ':L' . $fila)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $fila++;
        }

        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'lista_citas_usuarios.xlsx';

        // Limpiar el búfer de salida antes de enviar las cabeceras HTTP
        ob_end_clean();

        // Configurar cabeceras para la descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Leer y enviar el archivo Excel al navegador
        $writer->save('php://output');
        exit;
    }

    public function terminarCita(Cita $cita)
    {
        $conexion = new Conexion();
        $TurnoId = $cita->ObtenerCitaId();
        $TurnHFSoli = $cita->ObtenerHFSolicitada();
        $TurnHAsig = $cita->ObtenerHFAsignada();
        $TurnDetalle = $cita->ObtenerDetalle();
        $TurnObserva = $cita->ObtenerObservacion();
        $FunId = $cita->ObtenerFuncionario();
        $UsuId = $cita->ObtenerUsuario();
        $TuId = $cita->ObtenerTuId();
        $Estado = $cita->ObtenerEstado();

        // Concatenar "Cancelado:" con el estado actual
        $Estado = 'Completada: ' . $Estado;

        // Asegúrate de usar comillas simples para los valores de texto y escaparlos correctamente
        $sql = "UPDATE turno SET 
        TurnHFSoli = '$TurnHFSoli',
        TurnHAsig = '$TurnHAsig',
        TurnDetalle = '$TurnDetalle',
        TurnObserva = '$TurnObserva',
        FunId = '$FunId',  
        UsuId = '$UsuId',  
        TuId = '$TuId',
        Estado = '$Estado'   
        WHERE TurnoId = '$TurnoId'";

        $result = $conexion->ejecutar_query($sql);

        if ($result) {
            // Consulta para obtener el correo y nombre del funcionario
            $sql2 = "SELECT * FROM funcionarios WHERE FunId = '$FunId'";
            $conexion->buscar_query($sql2);

            if ($conexion->obtener_filas() > 0) {
                // Obtener resultados y asignar variables
                $funcionario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                $correoFuncionario = $funcionario['FunCorreo'];
                $nombreFuncionario = $funcionario['FunNombre'];

                // Consulta para obtener el nombre del usuario
                $sql3 = "SELECT * FROM usuario WHERE UsuId = '$UsuId'";
                $conexion->buscar_query($sql3);

                if ($conexion->obtener_filas() > 0) {
                    $usuario = $conexion->obtener_resultado()->fetch(PDO::FETCH_ASSOC);
                    $nombreUsuario = $usuario['UsuNombre'];

                    // Envío de correo electrónico al funcionario
                    $correo = new envio_mail();
                    $mensaje = "Hola " . $nombreFuncionario . ",<br><br>" .
                        "¡Un usuario ha cancelado una cita que ya tenías con él en la plataforma DIGITURNO!<br><br>" .
                        "Detalles de la cita:<br><br>" .
                        "Nombre del usuario: " . $nombreUsuario . "<br>" .
                        "Hora y fecha solicitada: " . $TurnHFSoli . "<br>" .
                        "Detalles: " . $TurnDetalle . "<br><br>" .
                        "Observacion: " . $TurnObserva . "<br><br>" .
                        "Motivo: " . $Estado . "<br><br>" .
                        "Motivo de porque cancela la cita: " . $Estado . "<br><br>" .
                        "Saludos cordiales,<br>" .
                        "El equipo de DIGITURNO";

                    $correo->recepcion($correoFuncionario);
                    $correo->mensaje("Cancelacion de Cita", $mensaje);
                    $correo->enviar();

                    echo "Cita editada y correo enviado correctamente.";
                } else {
                    echo "No se encontró un usuario con el ID proporcionado.";
                }
            } else {
                echo "No se encontró un funcionario con el ID proporcionado.";
            }
        } else {
            echo "Error al actualizar la cita.";
        }

        return $result;
    }
}
