<div class="container">
    <?php if ($result->rowCount() > 0) : ?>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle text-center table-bordered" id="administrador">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cambiar estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $result->fetch(PDO::FETCH_OBJ)) : ?>
                        <tr>
                            <td><?php echo $fila->AdminId; ?></td>
                            <td><?php echo $fila->AdminNom; ?></td>
                            <td><?php echo $fila->AdminApel; ?></td>
                            <td><?php echo $fila->AdminCorreo; ?></td>
                            <td><?php echo $fila->AdminTel; ?></td>
                            <td><?php echo $fila->Estado; ?></td>
                            <td>
                                <?php if ($fila->Estado == 'Activo') : ?>
                                    <?php if ($fila->AdminId == '65785214') : ?>
                                        <button class="btn btn-warning btn-sm custom-icon-button" disabled>
                                            <i class="bi bi-slash-circle"></i> Inactivar
                                        </button>
                                    <?php else : ?>
                                        <button class="btn btn-warning btn-sm custom-icon-button" onclick="cambiarEstadoAdminId(<?php echo $fila->AdminId; ?>, 'Inactivo')">
                                            <i class="bi bi-slash-circle"></i> Inactivar
                                        </button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <button class="btn btn-success btn-sm custom-icon-button" onclick="cambiarEstadoAdminId(<?php echo $fila->AdminId; ?>, 'Activo')">
                                        <i class="bi bi-check-circle"></i> Activar
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= ceil($totalUsuarios / $porPagina); $i++) : ?>
                        <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="#" onclick="Mostraradministradores(<?php echo $i; ?>)">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    <?php else : ?>
        <p>No se encontraron resultados</p>
    <?php endif; ?>
</div>
