<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradores</title>
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
                        <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Ajustes</a></li>
                        <li><a class="dropdown-item" href="index.php?accion=logoutAdmin">Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="container container-main">
        <div class="row">
            <div class="col-xxl-12">
                <div class='card-header'>
                    <div class="d-flex justify-content-between">
                        <div> <!-- Contenedor para alinear h2 y el menú -->
                            <h2>Administradores</h2>
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
                                    <li><a href="index.php?accion=tablaadministrador" class="dropdown-item">Administradores inscritos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <!-- Button trigger modal -->
                        <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#ingresaradministrador">
                            Registrar un Administradores
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="ingresaradministrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ingrese el nuevo usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (isset($_GET['alert_message'])) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo htmlspecialchars($_GET['alert_message']); ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                        <form action="index.php?accion=registraradmin" method="POST" id="registroForm">
                                            <div class="form-group">
                                                <label for="AdminId">Documento de identidad:</label>
                                                <input type="text" id="AdminId" name="AdminId" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="AdminNom">Nombre:</label>
                                                <input type="text" id="AdminNom" name="AdminNom" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="AdminApel">Apellido:</label>
                                                <input type="text" id="AdminApel" name="AdminApel" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="AdminTel">Numero Telefonico:</label>
                                                <input type="text" id="AdminTel" name="AdminTel" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="AdminCorreo">Correo electronico:</label>
                                                <input type="email" id="AdminCorreo" name="AdminCorreo" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="AdminContra">Contraseña:</label>
                                                <input type="password" id="AdminContra" name="AdminContra" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmarContra">Confirmar Contraseña:</label>
                                                <input type="password" id="confirmarContra" name="confirmarContra" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Estado" class="form-label">Estado Cuenta</label>
                                                <select class="form-select" id="Estado" name="Estado">
                                                    <option value="Activo">Activo</option>
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
                        <div class="input-group mt-3">
                            <input type="text" class="form-control col-sm-2" name="filtro" id="filtro" placeholder="Buscar Administrador">
                            <button class="custom-icon-button bi bi-search " onclick="Mostraradministradores()">Buscar</button>
                        </div>
                        <div id="administrador"></div>
                        <script>
                            Mostraradministradores();
                        </script>
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
</body>

<script src="Vista/js/validacion.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['alert_message']) && (strpos($_GET['alert_message'], 'correo electrónico') !== false || strpos($_GET['alert_message'], 'número de documento') !== false)) { ?>
                $('#ingresaradministrador').modal('show');
            <?php } ?>
        });
    </script>
</html>