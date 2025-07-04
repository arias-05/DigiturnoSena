<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center table-bordered" id="tablafuncionario">
            <thead class="table-light">
                <tr>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombre </th>
                    <th scope="col">Apellido </th>
                    <th scope="col">Telefono </th>
                    <th scope="col">Correo </th>
                    <th scope="col">Estado </th>
                    <th scope="col">Tipo Funcionario </th>
                    <th scope="col">Estado Cuenta</th>
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
                        <td><?php echo $fila->FunId; ?></td>
                        <td><?php echo $fila->FunNombre; ?></td>
                        <td><?php echo $fila->FunApellido; ?></td>
                        <td><?php echo $fila->FunTelefono; ?></td>
                        <td><?php echo $fila->FunCorreo; ?></td>
                        <td><?php echo $fila->Estado; ?></td>
                        <td><?php echo $fila->TipoFncionario; ?></td>
                        <td>
                            <?php if ($fila->Estado == 'Activo') : ?>
                                <button class="btn btn-warning btn-sm custom-icon-button" onclick="cambiarEstadoFunId(<?php echo $fila->FunId; ?>, 'Inactivo')">
                                    <i class="bi bi-slash-circle"></i> Inactivar
                                </button>
                            <?php else : ?>
                                <button class="btn btn-success btn-sm custom-icon-button" onclick="cambiarEstadoFunId(<?php echo $fila->FunId; ?>, 'Activo')">
                                    <i class="bi bi-check-circle"></i> Activar
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?accion=modificarregistrofuncio&edit=<?php echo $fila->FunId; ?>" class="btn btn-primary btn-sm custom-icon-button">
                                <i class="bi bi-pencil-square"></i>Editar
                            </a>
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