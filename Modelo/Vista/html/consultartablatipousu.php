<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center table-bordered" id="tablatipousu">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo Usuario</th>
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
                        <td><?php echo $fila->TuId; ?></td>
                        <td><?php echo $fila->TuDetalle; ?></td>
                        <td>
                            <button class="custom-icon-button" onclick="eliminarTuDetalle(<?php echo $fila->TuId; ?>)">
                                <i class="bi bi-trash3">Eliminar</i>
                            </button>
                        </td>
                        <td>
                            <a href="index.php?accion=modificartipousu&edit=<?php echo $fila->TuId; ?>" class="custom-icon-button"><i class="bi bi-pencil-square">Editar</i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    
} else {
    ?>
        <p>No hay tipos de Usuario</p>
    <?php
}
    ?>