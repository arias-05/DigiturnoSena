<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
                            <h1>Editar Funcionario (<?php echo $filas['FunNombre']; ?>)</h1>
                        </div>
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
                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#Registrarfun">
                            Actualizar Funcionario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="Registrarfun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ingrese el nuevo Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="index.php?accion=actualizarfuncionarios" method="POST">
                                            <div class="form-group">
                                                <label for="FunId">Documento de identidad:</label>
                                                <input type="number" id="FunId" name="FunId" class="form-control" required value="<?php echo $filas['FunId']; ?>" readonly>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="FunNombre">Nombre:</label>
                                                <input type="text" id="FunNombre" name="FunNombre" class="form-control" required value="<?php echo $filas['FunNombre']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="FunApellido">Apellido:</label>
                                                <input type="text" id="FunApellido" name="FunApellido" class="form-control" required value="<?php echo $filas['FunApellido']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="FunTelefono">Número de teléfono:</label>
                                                <input type="number" id="FunTelefono" name="FunTelefono" class="form-control" required value="<?php echo $filas['FunTelefono']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="FunCorreo">Correo electrónico:</label>
                                                <input type="email" id="FunCorreo" name="FunCorreo" class="form-control" required value="<?php echo $filas['FunCorreo']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="FunContraseña">Contraseña:</label>
                                                <input type="password" id="FunContrasena" name="FunContrasena" class="form-control" required value="<?php echo $filas['FunContrasena']; ?>" readonly>
                                                <span></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Estado" class="form-label">Estado </label>
                                                <select class="form-select" id="Estado" name="Estado" required>
                                                    <option selected disabled value="">Estado de servicio</option>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="TipoFunId" class="form-label">Tipo funcionario</label>
                                                <select class="form-select" id="TipoFunId" name="TipoFunId" required value="<?php echo $filas['TipoFunId']; ?>">
                                                    <option selected disabled value="">Elige el tipo de funcionario</option>

                                                    <?php
                                                    while ($fila2 = $result2->fetch(PDO::FETCH_OBJ)) {
                                                    ?>
                                                        <option value="<?php echo $fila2->TipoFunId; ?>"><?php echo $fila2->TipoFncionario; ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="custom-icon-button edit-button" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="custom-icon-button edit-button">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?accion=tablafuncionarios" class="custom-icon-button edit-button">Cancelar edición</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Documento
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['FunId']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Nombre
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['FunNombre']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Apellido
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['FunApellido']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Teléfono
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['FunTelefono']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Correo electrónico
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['FunCorreo']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Estado
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['Estado']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Tipo de Funcionario
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['TipoFunId']; ?></p>
                                </div>
                            </div>
                        </div>
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

    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['alert_message']) && (strpos($_GET['alert_message'], 'correo electrónico') !== false || strpos($_GET['alert_message'], 'número de documento') !== false)) { ?>
                $('#registro').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>