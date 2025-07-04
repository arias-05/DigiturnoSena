<?php
// Función para verificar si una cadena comienza con otra cadena
function startsWith($haystack, $needle)
{
    return strncmp($haystack, $needle, strlen($needle)) === 0;
}
?>

<?php

if (isset($_SESSION["AdminNom"]) && isset($_SESSION["AdminApel"])) {
    if ($result->rowCount() > 0) {
?>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle text-center table-bordered" id="citas">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hora y fecha solicitada</th>
                        <th scope="col">Hora y fecha asignada</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Observación</th>
                        <th scope="col">Funcionario</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Tipo usuario</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
                    ?>
                        <tr>
                            <td><?php echo $fila->TurnoId; ?></td>
                            <td><?php echo $fila->TurnHFSoli; ?></td>
                            <td><?php echo $fila->TurnHAsig; ?></td>
                            <td><?php echo formatLongText($fila->TurnDetalle); ?></td>
                            <td><?php echo formatLongText($fila->TurnObserva); ?></td>
                            <td><?php echo $fila->FunNombre; ?></td>
                            <td><?php echo $fila->UsuNombre; ?></td>
                            <td><?php echo $fila->TuDetalle; ?></td>
                            <td><?php echo $fila->Estado; ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
} else {
    if ($result->rowCount() > 0) {
    ?>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle text-center table-bordered" id="citas">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hora y fecha solicitada</th>
                        <th scope="col">Hora y fecha asignada</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Observación</th>
                        <?php if (!isset($_SESSION["FunNombre"])) : ?>
                            <th scope="col">Funcionario</th>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION["UsuNombre"])) : ?>
                            <th scope="col">Usuario</th>
                        <?php endif; ?>
                        <th scope="col">Tipo usuario</th>
                        <th scope="col"> Estado de la Cita</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
                        if (isset($_SESSION["UsuNombre"]) && $_SESSION["UsuNombre"] == $fila->UsuNombre) {
                    ?>
                            <tr>
                                <td><?php echo $fila->TurnoId; ?></td>
                                <td><?php echo $fila->TurnHFSoli; ?></td>
                                <td><?php echo $fila->TurnHAsig; ?></td>
                                <td><?php echo formatLongText($fila->TurnDetalle); ?></td>
                                <td><?php echo formatLongText($fila->TurnObserva); ?></td>
                                <?php if (!isset($_SESSION["FunNombre"])) : ?>
                                    <td><?php echo $fila->FunNombre; ?></td>
                                <?php endif; ?>
                                <?php if (!isset($_SESSION["UsuNombre"])) : ?>
                                    <td><?php echo $fila->UsuNombre; ?></td>
                                <?php endif; ?>
                                <td><?php echo $fila->TuDetalle; ?></td>
                                <td><?php echo $fila->Estado; ?></td>
                                <td>
                                    <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#cancelarCita_<?php echo $fila->TurnoId; ?>" <?php echo (startsWith($fila->Estado, 'Cancelado:') || startsWith($fila->Estado, 'Completada:')) ? 'disabled' : ''; ?>>
                                        Cancelar
                                    </button>

                                    <br><br>
                                    <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#editarCita_<?php echo $fila->TurnoId; ?>" <?php echo (startsWith($fila->Estado, 'Cancelado:') || startsWith($fila->Estado, 'Completada:') || $fila->Estado === 'Asignada') ? 'disabled' : ''; ?>>
                                        Editar
                                    </button>

                                    <!-- Modal para cancelar cita -->
                                    <div class="modal fade" id="cancelarCita_<?php echo $fila->TurnoId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cancelar Cita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para confirmar cancelación -->
                                                    <form action="index.php?accion=cancelarcita" method="POST">
                                                        <input type="hidden" name="TurnoId" value="<?php echo $fila->TurnoId; ?>">
                                                        <div class="mb-3">
                                                            <label for="TurnoId" class="form-label">Número de cita</label>
                                                            <input type="text" class="form-control" id="TurnoId" name="TurnoId" value="<?php echo $fila->TurnoId; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHFSoli" class="form-label">Fecha y Hora Solicitada</label>
                                                            <input type="text" class="form-control" id="TurnHFSoli" name="TurnHFSoli" value="<?php echo $fila->TurnHFSoli; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHAsig" class="form-label">Fecha y Hora Asignada</label>
                                                            <input type="text" class="form-control" id="TurnHAsig" name="TurnHAsig" value="<?php echo $fila->TurnHAsig; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">El motivo de la cita</label>
                                                            <textarea id="TurnDetalle" name="TurnDetalle" class="form-control" rows="5" cols="40" readonly style="color: gray;"><?php echo htmlspecialchars($fila->TurnDetalle); ?></textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="TurnObserva" class="form-label">Observaciones de la cita</label>
                                                            <textarea id="TurnObserva" name="TurnObserva" class="form-control" rows="5" cols="40" readonly style="color: gray;"><?php echo htmlspecialchars($fila->TurnObserva); ?></textarea>
                                                        </div>
                                                        <input type="hidden" name="FunId" value="<?php echo $fila->FunId; ?>">
                                                        <input type="hidden" name="UsuId" value="<?php echo $_SESSION["UsuId"]; ?>">
                                                        <input type="hidden" name="TuId" value="<?php echo $_SESSION["TuId"]; ?>">
                                                        <div class="form-group">
                                                            <label for="Estado">Por qué quieres Cancelar la Cita:</label>
                                                            <textarea id="Estado" name="Estado" class="form-control" rows="10" cols="40" required><?php echo htmlspecialchars($fila->Estado); ?></textarea>
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Salir</button>
                                                            <button type="submit" class="custom-icon-button edit-button">Confirmar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal para editar cita -->
                                    <div class="modal fade" id="editarCita_<?php echo $fila->TurnoId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para editar cita -->
                                                    <form action="index.php?accion=editarcitausu" method="POST">
                                                        <input type="hidden" name="TurnoId" value="<?php echo $fila->TurnoId; ?>">
                                                        <div class="mb-3">
                                                            <label for="TurnoId" class="form-label">Número de cita</label>
                                                            <input type="text" class="form-control" id="TurnoId" name="TurnoId" value="<?php echo $fila->TurnoId; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHFSoli" class="form-label">Fecha y Hora Solicitada</label>
                                                            <input type="datetime-local" class="form-control" id="TurnHFSoli" name="TurnHFSoli" value="<?php echo $fila->TurnHFSoli; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">Añade un nuevo detalle</label>
                                                            <input type="text" class="form-control" id="TurnDetalle" name="TurnDetalle">
                                                        </div>
                                                        <input type="hidden" name="FunId" value="<?php echo $fila->FunId; ?>">
                                                        <input type="hidden" name="UsuId" value="<?php echo $_SESSION["UsuId"]; ?>">
                                                        <input type="hidden" name="TuId" value="<?php echo $_SESSION["TuId"]; ?>">
                                                        <input type="hidden" name="Estado" value="<?php echo htmlspecialchars($fila->Estado); ?>">

                                                        <div class="modal-footer">
                                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Salir</button>
                                                            <button type="submit" class="custom-icon-button edit-button">Guardar cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                        <?php
                        } elseif (isset($_SESSION["FunNombre"]) && $_SESSION["FunNombre"] == $fila->FunNombre) {
                        ?>
                            <tr>
                                <td><?php echo $fila->TurnoId; ?></td>
                                <td><?php echo $fila->TurnHFSoli; ?></td>
                                <td><?php echo $fila->TurnHAsig; ?></td>
                                <td><?php echo formatLongText($fila->TurnDetalle); ?></td>
                                <td><?php echo formatLongText($fila->TurnObserva); ?></td>
                                <?php if (!isset($_SESSION["FunNombre"])) : ?>
                                    <td><?php echo $fila->FunNombre; ?></td>
                                <?php endif; ?>
                                <?php if (!isset($_SESSION["UsuNombre"])) : ?>
                                    <td><?php echo $fila->UsuNombre; ?></td>
                                <?php endif; ?>
                                <td><?php echo $fila->TuDetalle; ?></td>
                                <td><?php echo $fila->Estado; ?></td>

                                <td>
                                    <?php if ($fila->Estado === 'Asignada') : ?>
                                        <!-- Botón para editar cita asignada -->
                                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#editarCitaAsignada_<?php echo $fila->TurnoId; ?>">
                                            Editar
                                        </button>
                                    <?php else : ?>
                                        <!-- Botón para agendar cita -->
                                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#agendarCita_<?php echo $fila->TurnoId; ?>" <?php echo startsWith($fila->Estado, 'Completada:') || startsWith($fila->Estado, 'Cancelado:') ? 'disabled' : ''; ?>>
                                            Agendar
                                        </button>
                                    <?php endif; ?>
                                    <br><br>
                                    <?php if ($fila->Estado === 'Asignada') : ?>
                                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#finalizarCita_<?php echo $fila->TurnoId; ?>">
                                            Finalizar
                                        </button>
                                    <?php endif; ?>

                                    <!-- modal para terminar cita -->
                                    <div class="modal fade" id="finalizarCita_<?php echo $fila->TurnoId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Finalizar Cita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para terminar cita -->
                                                    <form action="index.php?accion=terminarCita" method="POST">
                                                        <input type="hidden" name="TurnoId" value="<?php echo $fila->TurnoId; ?>">
                                                        <div class="mb-3">
                                                            <label for="TurnoId" class="form-label">Número de cita</label>
                                                            <input type="text" class="form-control" id="TurnoId" name="TurnoId" value="<?php echo $fila->TurnoId; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHFSoli" class="form-label">Fecha y Hora Solicitada</label>
                                                            <input type="text" class="form-control" id="TurnHFSoli" name="TurnHFSoli" value="<?php echo $fila->TurnHFSoli; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHAsig" class="form-label">Fecha y Hora Asignada</label>
                                                            <input type="text" class="form-control" id="TurnHAsig" name="TurnHAsig" value="<?php echo $fila->TurnHAsig; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">El motivo de la cita</label>
                                                            <textarea id="TurnDetalle" name="TurnDetalle" class="form-control" rows="5" cols="40" readonly style="color: gray;"><?php echo htmlspecialchars($fila->TurnDetalle); ?></textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="TurnObserva" class="form-label">Observaciones de la cita</label>
                                                            <textarea id="TurnObserva" name="TurnObserva" class="form-control" rows="5" cols="40" readonly style="color: gray;"><?php echo htmlspecialchars($fila->TurnObserva); ?></textarea>
                                                        </div>
                                                        <input type="hidden" name="FunId" value="<?php echo $_SESSION["FunId"]; ?>">
                                                        <input type="hidden" name="UsuId" value="<?php echo $fila->UsuId; ?>">
                                                        <input type="hidden" name="TuId" value="<?php echo $fila->TuId; ?>">
                                                        <div class="form-group">
                                                            <label for="Estado">quieres colocar alguna observacion:</label>
                                                            <textarea id="Estado" name="Estado" class="form-control" rows="10" cols="40" required><?php echo htmlspecialchars($fila->Estado); ?></textarea>
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Salir</button>
                                                            <button type="submit" class="custom-icon-button edit-button">Confirmar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal para Agendar cita -->
                                    <div class="modal fade" id="agendarCita_<?php echo $fila->TurnoId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Agendar Cita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para editar cita -->
                                                    <form action="index.php?accion=agendarCitaFun" method="POST" onsubmit="return validarFechaHoraSolicitada(this['TurnHAsig'])">
                                                        <input type="hidden" name="TurnoId" value="<?php echo $fila->TurnoId; ?>">
                                                        <div class="mb-3">
                                                            <label for="TurnoId" class="form-label">Número de cita</label>
                                                            <input type="text" class="form-control" id="TurnoId" name="TurnoId" value="<?php echo $fila->TurnoId; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHFSoli" class="form-label">Fecha y Hora Solicitada</label>
                                                            <input type="datetime-local" class="form-control" id="TurnHFSoli" name="TurnHFSoli" value="<?php echo $fila->TurnHFSoli; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHAsig" class="form-label">Fecha y Hora Que lo vas a Atender</label>
                                                            <input type="datetime-local" class="form-control" id="TurnHAsig" name="TurnHAsig" value="<?php echo $fila->TurnHAsig; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">El motivo de la cita</label>
                                                            <input type="text" class="form-control" id="TurnDetalle" name="TurnDetalle" value="<?php echo $fila->TurnDetalle; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">Observacion de la cita</label>
                                                            <input type="text" class="form-control" id="TurnObserva" name="TurnObserva" value="<?php echo $fila->TurnObserva; ?>">
                                                        </div>
                                                        <input type="hidden" name="FunId" value="<?php echo $_SESSION["FunId"]; ?>">
                                                        <input type="hidden" name="UsuId" value="<?php echo $fila->UsuId; ?>">
                                                        <input type="hidden" name="TuId" value="<?php echo $fila->TuId; ?>">
                                                        <input type="hidden" name="Estado" value="Asignada">
                                                        <div class="modal-footer">
                                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Salir</button>
                                                            <button type="submit" class="custom-icon-button edit-button">Agendar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editarCitaAsignada_<?php echo $fila->TurnoId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cita Asignada</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para editar cita asignada -->
                                                    <form action="index.php?accion=editarCitaAsignada" method="POST" onsubmit="return validarFechaHoraSolicitada(this['TurnHAsig'])">
                                                        <input type="hidden" name="TurnoId" value="<?php echo $fila->TurnoId; ?>">
                                                        <div class="mb-3">
                                                            <label for="TurnoId" class="form-label">Número de cita</label>
                                                            <input type="text" class="form-control" id="TurnoId" name="TurnoId" value="<?php echo $fila->TurnoId; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHFSoli" class="form-label">Fecha y Hora Solicitada</label>
                                                            <input type="datetime-local" class="form-control" id="TurnHFSoli" name="TurnHFSoli" value="<?php echo $fila->TurnHFSoli; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnHAsig" class="form-label">Fecha y Hora Que lo vas a Atender</label>
                                                            <input type="datetime-local" class="form-control" id="TurnHAsig" name="TurnHAsig" value="<?php echo $fila->TurnHAsig; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">El motivo de la cita</label>
                                                            <input type="text" class="form-control" id="TurnDetalle" name="TurnDetalle" value="<?php echo $fila->TurnDetalle; ?>" readonly style="color: gray;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="TurnDetalle" class="form-label">Por que quieres editar la cita</label>
                                                            <input type="text" class="form-control" id="TurnObserva" name="TurnObserva">
                                                        </div>
                                                        <input type="hidden" name="FunId" value="<?php echo $_SESSION["FunId"]; ?>">
                                                        <input type="hidden" name="UsuId" value="<?php echo $fila->UsuId; ?>">
                                                        <input type="hidden" name="TuId" value="<?php echo $fila->TuId; ?>">
                                                        <input type="hidden" name="Estado" value="Asignada">
                                                        <div class="modal-footer">
                                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Salir</button>
                                                            <button type="submit" class="custom-icon-button edit-button">Guardar cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}
?>
<?php


function formatLongText($text)
{
    // Separar las palabras largas sin espacios con un guion al final de cada línea
    $words = str_split($text, 25); // 50 caracteres por línea (ajustar según sea necesario)
    return implode("-<br>", $words);
}
?>
<script src="Vista/js/citas.js"></script>