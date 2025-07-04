
<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center table-bordered" id="tipofuncionario">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo funcionario</th>
                    <th scope="col">Eliminar</th>
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
                        <td><?php echo $fila->TipoFunId; ?></td>
                        <td><?php echo $fila->TipoFncionario; ?></td>
                        <td>
                            <button class="custom-icon-button" onclick="eliminarTipoFunId(<?php echo $fila->TipoFunId; ?>)">
                                <i class="bi bi-trash3">Eliminar</i>
                            </button>
                        </td>
                        <td>
                        <a href="index.php?accion=modificartipofuncionarios&edit=<?php echo $fila->TipoFunId; ?>" class="custom-icon-button"><i class="bi bi-pencil-square">Editar</i></a>
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