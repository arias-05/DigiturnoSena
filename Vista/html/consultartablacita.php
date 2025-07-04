<?php
// Función para verificar si una cadena comienza con otra cadena
function startsWith($haystack, $needle)
{
    return strncmp($haystack, $needle, strlen($needle)) === 0;
}

function formatLongText($text)
{
    // Separar las palabras largas sin espacios con un guion al final de cada línea
    $words = str_split($text, 25); // 25 caracteres por línea (ajustar según sea necesario)
    return implode("-<br>", $words);
}
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
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= ceil($totalCitas / $porPagina); $i++) : ?>
                <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="#" onclick="cita(<?php echo $i; ?>)">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script src="Vista/js/citas.js"></script>