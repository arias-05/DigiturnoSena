<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo con Bootstrap</title>
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
                        <div>
                            <?php $filas = $result->fetch(); ?>
                            <h1>Editar Usuario (<?php echo $filas['UsuNombre']; ?>)</h1>
                        </div>
                        <div>
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
                        <button type="button" class="custom-icon-button edit-button mb-3" data-bs-toggle="modal" data-bs-target="#Registrar">
                            Actualizar Usuario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="Registrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="index.php?accion=actualizarregistro" method="POST" id="registroForm">
                                            <div class="form-group">
                                                <label for="UsuId">Documento de identidad:</label>
                                                <input type="text" id="UsuId" name="UsuId" class="form-control" required value="<?php echo $filas['UsuId'] ?? ''; ?>" readonly>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuNombre">Nombre:</label>
                                                <input type="text" id="UsuNombre" name="UsuNombre" class="form-control" required value="<?php echo $filas['UsuNombre']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuApellido">Apellido:</label>
                                                <input type="text" id="UsuApellido" name="UsuApellido" class="form-control" required value="<?php echo $filas['UsuApellido']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuCorreo">Correo electrónico:</label>
                                                <input type="email" id="UsuCorreo" name="UsuCorreo" class="form-control" required value="<?php echo $filas['UsuCorreo']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuTelefono">Número de teléfono:</label>
                                                <input type="text" id="UsuTelefono" name="UsuTelefono" class="form-control" required value="<?php echo $filas['UsuTelefono']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuContra">Contraseña:</label>
                                                <input type="password" id="Usucontra" name="Usucontra" class="form-control" required value="<?php echo $filas['Usucontra']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmarContra">Confirmar Contraseña:</label>
                                                <input type="password" id="confirmarContra" name="confirmarContra" class="form-control" required value="<?php echo $filas['Usucontra']; ?>">
                                                <span></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Estado" class="form-label">Estado Cuenta</label>
                                                <select class="form-select" id="Estado" name="Estado" required value="<?php echo $filas['Estado']; ?>">>
                                                    <option value="Activa">Activo</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="TipoUsuario" class="form-label">Tipo de Usuario </label>
                                                <select class="form-select" id="TuId" name="TuId" required>
                                                    <option selected disabled value="">Elige el tipo de usuario</option>
                                                    <?php while ($fila2 = $result2->fetch(PDO::FETCH_OBJ)) { ?>
                                                        <option value="<?php echo $fila2->TuId; ?>"><?php echo $fila2->TuDetalle; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="custom-icon-button edit-button" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="custom-icon-button edit-button">Registrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?accion=tablaregistros" class="custom-icon-button edit-button">Cancelar edición</a>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Documento de identidad
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['UsuId']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Nombre
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['UsuNombre']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Apellido
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['UsuApellido']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Correo electrónico
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['UsuCorreo']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Número de teléfono
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['UsuTelefono']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Tipo de Usuario
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $filas['TuId']; ?></p>
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
    <script src="Vista/js/validacion.js"></script>

    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['alert_message']) && (strpos($_GET['alert_message'], 'correo electrónico') !== false || strpos($_GET['alert_message'], 'número de documento') !== false)) { ?>
                $('#registro').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>