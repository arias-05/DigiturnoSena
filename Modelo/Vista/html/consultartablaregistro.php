<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover align-middle text-center table-bordered" id="tablaregistro">
            <thead class="table-light">
                <tr>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Tipo Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cambiar estado</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
                    $count++;
                ?>
                    <tr>
                        <td><?php echo $fila->UsuId; ?></td>
                        <td><?php echo $fila->UsuNombre; ?></td>
                        <td><?php echo $fila->UsuApellido; ?></td>
                        <td><?php echo $fila->UsuCorreo; ?></td>
                        <td><?php echo $fila->UsuTelefono; ?></td>
                        <td><?php echo $fila->TuDetalle; ?></td>
                        <td><?php echo $fila->Estado; ?></td>
                        <td>
                            <?php if ($fila->Estado == 'Activa') : ?>
                                <button class="btn btn-warning btn-sm custom-icon-button" onclick="cambiarEstadoUsuId(<?php echo $fila->UsuId; ?>, 'Inactiva')">
                                    <i class="bi bi-slash-circle"></i> Inactivar
                                </button>
                            <?php else : ?>
                                <button class="btn btn-success btn-sm custom-icon-button" onclick="cambiarEstadoUsuId(<?php echo $fila->UsuId; ?>, 'Activa')">
                                    <i class="bi bi-check-circle"></i> Activar
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?accion=modificarregistros&edit=<?php echo $fila->UsuId; ?>" class="btn btn-primary btn-sm custom-icon-button">
                                <i class="bi bi-pencil-square"></i>Editar
                            </a>
                        </td>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
?>