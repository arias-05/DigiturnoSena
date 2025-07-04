<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="Vista/css/styles.css">
    <script src="Vista/js/java_forms.js"></script>
    <script src="Vista/js/logins.js"></script>


</head>

<body>
    <header class="header1">
        <div>
            <h1>DIGITURNO SENA</h1>
        </div>
        <div>
            <!-- Contenedor para alinear a la derecha -->
            <div class="d-flex justify-content-end">
                <!-- Botón desencadenante del menú desplegable -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["FunNombre"], " ", $_SESSION["FunApellido"]; ?>
                    </button>
                    <!-- Lista de opciones del menú desplegable -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#miPerfilModal">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="index.php?accion=logoutFun">Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="miPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mi Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?accion=actualizarPerfilFuncionario" method="POST" id="registroForm">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row mb-3">
                                    <label for="UsuId" class="col-sm-4 col-form-label">Documento de identidad:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="UsuId" name="UsuId" class="form-control" required value="<?php echo $_SESSION['FunId'] ?? ''; ?>" readonly>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuNombre" class="col-sm-4 col-form-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="UsuNombre" name="UsuNombre" class="form-control" required value="<?php echo $_SESSION['FunNombre']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuApellido" class="col-sm-4 col-form-label">Apellido:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="UsuApellido" name="UsuApellido" class="form-control" required value="<?php echo $_SESSION['FunApellido']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuTelefono" class="col-sm-4 col-form-label">Número de teléfono:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="UsuTelefono" name="UsuTelefono" class="form-control" required value="<?php echo $_SESSION['FunTelefono']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuCorreo" class="col-sm-4 col-form-label">Correo electrónico:</label>
                                    <div class="col-sm-8">
                                        <input type="email" id="UsuCorreo" name="UsuCorreo" class="form-control" required value="<?php echo $_SESSION['FunCorreo']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuContra" class="col-sm-4 col-form-label">Contraseña:</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="Usucontra" name="Usucontra" class="form-control" required value="<?php echo $_SESSION['FunContrasena']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="confirmarContra" class="col-sm-4 col-form-label">Confirmar Contraseña:</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="confirmarContra" name="confirmarContra" class="form-control" required value="<?php echo $_SESSION['FunContrasena']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <input type="hidden" name="TuId" value="<?php echo $_SESSION["Estado"]; ?>">
                                <input type="hidden" name="Estado" value="<?php echo $_SESSION["TipoFunId"]; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
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
                            <h2>Citas registradas</h2>
                        </div>
                    </div>

                    <button type="button" class="custom-icon-button edit-button" data-bs-toggle="modal" data-bs-target="#modalDescargaCitas">
                        Descargar Registro de Citas
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalDescargaCitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Descargar Citas por Fecha de Solicitud</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php?accion=registroCitasFuncionario" method="post">
                                        <div class="mb-3">
                                            <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                            <input type="date" class="form-control" id="FechaInicio" name="FechaInicio" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                                            <input type="date" class="form-control" id="FechaFin" name="FechaFin" required>
                                        </div>
                                        <input type="hidden" name="FunId" value="<?php echo $_SESSION['FunId']; ?>">
                                        <button type="submit" class="btn btn-primary">Descargar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='card-body'>

                        <div class="input-group mt-3">
                            <input type="text" class="form-control col-sm-2" name="filtro" id="filtro" placeholder="Buscar cita">
                            <button class="custom-icon-button bi bi-search " onclick="cita()"> Buscar</button>
                        </div>

                        <div id="citas"></div>
                        <script>
                            cita();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>