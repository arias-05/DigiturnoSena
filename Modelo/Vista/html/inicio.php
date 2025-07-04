<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digiturno</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Vista/css/styles.css">
</head>

<body>

    <header>
        <div>
            <h1>DIGITURNO SENA</h1>
        </div>
        <div>
            <img src="Vista/img/sena.png" alt="Logo a la derecha" class="logo">
        </div>
    </header>

    <div class="container container-main">
        <div class="row">
            <div class="col-xxl-12 col-md-7">
                <!-- Carrusel de imágenes -->
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Vista/img/carousel (1).jpg" class="d-block w-100 " alt="..." style="width: 50px; height: 510px;">
                        </div>
                        <div class="carousel-item">
                            <img src="Vista/img/carousel (2).png" class="d-block w-100" alt="..." style="width: 50px; height: 510px;">
                        </div>
                        <div class="carousel-item">
                            <img src="Vista/img/carousel (3).png" class="d-block w-100" alt="..." style="width: 50px; height: 510px;">
                        </div>
                    </div>
                    <!-- Controles del carrusel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-xxl-12 col-md-5">
                <!-- Contenedor de pestañas de navegación -->
                <div class="nav-tabs-container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Aprendices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Funcionarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Administradores</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <!-- Formulario de Inicio de Sesión para Aprendices -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div id="formularioInicioSesionAprendices">
                                <form action="index.php?accion=loginUsuario" method="post">
                                    <br>
                                    <!-- Mensajes de error -->
                                    <?php if (isset($_GET['erro'])) : ?>
                                        <?php if ($_GET['erro'] == 1) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                Usuario o contraseña incorrectos.
                                            </div>
                                        <?php elseif ($_GET['erro'] == 2) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                El usuario está inactivo.
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="input_group">
                                        <label class="label" for="UsuIdAprendices">Documento</label>
                                        <input type="number" id="UsuIdAprendices" name="UsuId" class="form-control" required>
                                    </div>
                                    <div class="input_group">
                                        <label class="label" for="UsucontraAprendices">Contraseña</label>
                                        <input type="password" id="UsucontraAprendices" name="Usucontra" class="form-control" required>
                                        <span id="togglePassword1">Mostrar</span>
                                    </div>
                                    <br>
                                    <div class="input_group">
                                        <a class="custom-link" onclick="mostrarFormularioRecuperarContraseña('aprendices')">¿Olvidaste
                                            tu contraseña?</a>
                                    </div>
                                    <br>
                                    <button type="submit" class="custom-icon-button edit-button">Iniciar Sesión</button>
                                    <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#RegistrarUsuario">
                                        Registrate
                                    </button>
                                </form>
                            </div>
                            <div id="formularioRecuperarContraseñaAprendices" style="display: none;">
                                <br>
                                <!-- Formulario para recuperar la contraseña de Aprendices -->
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'usuarioNoEncontrado') : ?>
                                    <div class="alert alert-danger" role="alert">
                                        No se encontró un usuario con el documento proporcionado.
                                    </div>
                                <?php endif; ?>
                                <form action="index.php?accion=olvidarContrasenaUsuario" method="post">
                                    <div class="input_group">
                                        <label class="label" for="UsuIdRecuperarAprendices">Documento</label>
                                        <input type="number" id="UsuIdRecuperarAprendices" name="UsuId" class="form-control" required>
                                    </div>
                                    <br>
                                    <button type="button" class="custom-icon-button edit-button" onclick="mostrarFormularioInicioSesion('aprendices')">Cancelar</button>
                                    <button type="submit" class="custom-icon-button edit-button">Recuperar
                                        Contraseña</button>
                                </form>
                            </div>
                        </div>


                        <!-- Modal de registro de usuario -->
                        <div class="modal fade" id="RegistrarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Mensajes de alerta -->
                                        <?php if (isset($_GET['alert_message'])) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo htmlspecialchars($_GET['alert_message']); ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                        <form action="index.php?accion=registrarusuarios" method="POST" id="registroForm">
                                            <div class="form-group">
                                                <label for="UsuId">Documento de identidad:</label>
                                                <input type="text" id="UsuId" name="UsuId" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuNombre">Nombre:</label>
                                                <input type="text" id="UsuNombre" name="UsuNombre" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuApellido">Apellido:</label>
                                                <input type="text" id="UsuApellido" name="UsuApellido" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuCorreo">Correo electrónico:</label>
                                                <input type="email" id="UsuCorreo" name="UsuCorreo" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuTelefono">Número de teléfono:</label>
                                                <input type="text" id="UsuTelefono" name="UsuTelefono" class="form-control" required>
                                                <span></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="UsuContra">Contraseña:</label>
                                                <input type="password" id="Usucontra" name="Usucontra" class="form-control" required>
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
                                                    <option value="Activa">Activo</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="TipoUsuario" class="form-label">Tipo de Usuario </label>
                                                <select class="form-select" id="TuId" name="TuId" required>
                                                    <option selected disabled value="">Elige el tipo de usuario</option>
                                                    <?php while ($fila = $result->fetch(PDO::FETCH_OBJ)) { ?>
                                                        <option value="<?php echo $fila->TuId; ?>"><?php echo $fila->TuDetalle; ?></option>
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
                        <!-- Formulario de Inicio de Sesión para Funcionarios -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div id="formularioInicioSesionFuncionarios">
                                <form action="index.php?accion=loginFuncionario" method="post">
                                    <br>
                                    <!-- Mensajes de error -->

                                    <?php if (isset($_GET['error'])) : ?>
                                        <?php if ($_GET['error'] == 1) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                Usuario o contraseña incorrectos.
                                            </div>
                                        <?php elseif ($_GET['error'] == 2) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                El Funcionario está inactivo.
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="input_group">
                                        <label class="label" for="FunIdFuncionarios">Documento</label>
                                        <input type="number" id="FunIdFuncionarios" name="FunId" class="form-control" required>
                                    </div>
                                    <div class="input_group">
                                        <label class="label" for="FunContrasenaFuncionarios">Contraseña</label>
                                        <input type="password" id="FunContrasenaFuncionarios" name="FunContrasena" class="form-control" required>
                                        <span id="togglePassword2" class="toggle-password">Mostrar</span>
                                    </div>
                                    <br>
                                    <div class="input_group">
                                        <a class="custom-link" onclick="mostrarFormularioRecuperarContraseña('funcionarios')">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <br>
                                    <button type="submit" class="custom-icon-button edit-button">Iniciar Sesión</button>
                                </form>

                            </div>
                            <div id="formularioRecuperarContraseñaFuncionarios" style="display: none;">
                                <br>
                                <!-- Formulario para recuperar la contraseña de Funcionarios -->
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'FuncionarioNoEncontrado') : ?>
                                    <div class="alert alert-danger" role="alert">
                                        No se encontró un Funcionario con el documento proporcionado.
                                    </div>
                                <?php endif; ?>
                                <form action="index.php?accion=olvidarContrasenaFuncionario" method="post">
                                    <div class="input_group">
                                        <label class="label" for="FunIdRecuperarFuncionarios">Documento</label>
                                        <input type="number" id="FunIdRecuperarFuncionarios" name="FunId" class="form-control" required>
                                    </div>
                                    <br>
                                    <button type="button" class="custom-icon-button edit-button" onclick="mostrarFormularioInicioSesion('funcionarios')">Cancelar</button>
                                    <button type="submit" class="custom-icon-button edit-button">Recuperar Contraseña</button>
                                </form>
                            </div>
                        </div>

                        <!-- Formulario de Inicio de Sesión para Administradores -->
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div id="formularioInicioSesionAdministradores">
                                <form action="index.php?accion=loginAdministrador" method="post">
                                    <br>
                                    <!-- Mensajes de error -->
                                    <?php if (isset($_GET['err'])) : ?>
                                        <?php if ($_GET['err'] == 1) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                Usuario o contraseña incorrectos.
                                            </div>
                                        <?php elseif ($_GET['err'] == 2) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                El Administrador está inactivo.
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="input_group">
                                        <label class="label" for="loginUsuarioAdministradores">Documento</label>
                                        <input type="number" id="AdminIdAdministradores" name="AdminId" class="form-control" required>
                                    </div>
                                    <div class="input_group">
                                        <label class="label" for="loginPasswordAdministradores">Contraseña</label>
                                        <input type="password" id="AdminContrasenaAdministradores" name="AdminContra" class="form-control" required>
                                        <span id="togglePassword3" class="toggle-password">Mostrar</span>
                                    </div>
                                    <br>
                                    <div class="input_group">
                                        <a class="custom-link" onclick="mostrarFormularioRecuperarContraseña('administradores')">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <br>
                                    <button type="submit" class="custom-icon-button edit-button">Iniciar Sesión</button>

                                </form>
                            </div>
                            <div id="formularioRecuperarContraseñaAdministradores" style="display: none;">
                                <br>
                                <!-- Formulario para recuperar la contraseña de Administradores -->
                                <?php if (isset($_GET['error']) && $_GET['error'] == 'AdminNoEncontrado') : ?>
                                    <div class="alert alert-danger" role="alert">
                                        No se encontró un Administrador con el documento proporcionado.
                                    </div>
                                <?php endif; ?>
                                <form action="index.php?accion=olvidarContrasenaAdministrador" method="post">
                                    <div class="input_group">
                                        <label class="label" for="AdminIdRecuperarAdministradores">Documento</label>
                                        <input type="number" id="AdminIdRecuperarAdministradores" name="AdminId" class="form-control" required>
                                    </div>
                                    <br>
                                    <button type="button" class="custom-icon-button edit-button" onclick="mostrarFormularioInicioSesion('administradores')">Cancelar</button>
                                    <button type="submit" class="custom-icon-button edit-button">Recuperar Contraseña</button>
                                </form>
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

    <script src="Vista/js/logins.js"></script>
    <script src="Vista/js/validacion.js"></script>


    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['alert_message']) && (strpos($_GET['alert_message'], 'correo electrónico') !== false || strpos($_GET['alert_message'], 'número de documento') !== false)) { ?>
                $('#RegistrarUsuario').modal('show');
            <?php } ?>
        });
    </script>
    </script>
</body>

</html>