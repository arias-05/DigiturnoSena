<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="Vista/css/styles.css">
    <script src="Vista/js/java_forms.js"></script>


</head>

<body>
    <header>
        <div>
            <h1>DIGITURNO SENA</h1>
        </div>
        <div>
            <!-- Contenedor para alinear a la derecha -->
            <div class="d-flex justify-content-end">
                <!-- Botón desencadenante del menú desplegable -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["AdminNom"], " ", $_SESSION["AdminApel"]; ?>
                    </button>
                    <!-- Lista de opciones del menú desplegable -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#miPerfilModal">Mi Perfil</a></li>
                    <li><a class="dropdown-item" href="index.php?accion=logoutAdmin">Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <?php include 'miperfiladmin.php'; ?>
    <div class="container container-main">
        <div class="row">
            <div class="col-xxl-12">
                <div class='card-header'>
                    <div class="d-flex justify-content-between">
                        <div> <!-- Contenedor para alinear h2 y el menú -->
                        <?php $filas = $result->fetch(); ?>
                        <h1>Editar Funcionario (<?php echo $filas['TipoFncionario']; ?>)</h1>                        </div>
                        <div> <!-- Contenedor para el dropdown -->
                        <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li><a href="index.php?accion=tablaregistros" class="dropdown-item">Registro Usuario</a></li>
                                    <li><a href="index.php?accion=tablatipousuario" class="dropdown-item">Tipos Usuarios</a></li>
                                    <li><a href="index.php?accion=tablatipofuncionarios" class="dropdown-item">Tipos funcionarios</a></li>
                                    <li><a href="index.php?accion=tablafuncionarios" class="dropdown-item">Funcionarios Inscritos</a></li>
                                    <li><a href="index.php?accion=vistaadministrador" class="dropdown-item">Citas Registradas</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='card-body mb-3'>
                        <!-- Button trigger modal -->
                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#actualizartipofuncionario">
                            Actualizar Tipo Funcionario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="actualizartipofuncionario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Tipo Funcionario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="actualizartipofuncionario" novalidate method="post" action="index.php?accion=actualizartipofunci">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="TipoFunId" class="form-label">Id tipo de funcionario</label>
                                                <input type="text" class="form-control" id="TipoFunId" name="TipoFunId" required value="<?php echo $filas['TipoFunId']; ?> *No modificable*" readonly style="color: gray;">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Nuevo nombre tipo funcionario</label>
                                                <input type="text" class="form-control" id="TipoFncionario" name="TipoFncionario" required value="<?php echo $filas['TipoFncionario']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="custom-icon-button edit-button" onclick="alert('Se actualizo correctamente el tipo usuario <?php echo $filas['TipoFncionario']; ?> ');">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?accion=tablatipofuncionarios" class="custom-icon-button edit-button">Cancelar edición</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle text-center table-bordered" id="tablatipousu">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tipo Funcionario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $filas['TipoFunId']; ?></td>
                                    <td><?php echo $filas['TipoFncionario']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4 style="margin-top: 20px;">Contacto</h4>
                    <p>Nacional de Aprendizaje SENA-Centro de Industria y Construcción-Regional Tolima Dirección: Carrera 45 Sur Nº 141-05 Sector Picaleña, contiguo casa de la Moneda</p>
                </div>
                <div class="col-6">
                    <h4 style="margin-top: 20px;">Síguenos en redes sociales</h4>
                    <div class="social-buttons">
                        <button style="border: none; background: none; cursor: pointer; margin: 0 10px;">
                            <img src="Vista/img/facebook.png" alt="Facebook" style="width: 50px; height: 50px;">
                        </button>
                        <button style="border: none; background: none; cursor: pointer; margin: 0 10px;">
                            <img src="Vista/img/instagram.png" alt="Instagram" style="width: 50px; height: 50px;">
                        </button>
                        <button style="border: none; background: none; cursor: pointer; margin: 0 10px;">
                            <img src="Vista/img/twitter.png" alt="Twitter" style="width: 50px; height: 50px;">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>