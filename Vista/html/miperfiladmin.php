<div class="modal fade" id="miPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mi Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?accion=actualizarPerfilAdmin" method="POST" id="registroForm">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row mb-3">
                                    <label for="UsuId" class="col-sm-4 col-form-label">Documento de identidad:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="AdminId" name="AdminId" class="form-control" required value="<?php echo $_SESSION['AdminId'] ?? ''; ?>" readonly>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuNombre" class="col-sm-4 col-form-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="AdminNom" name="AdminNom" class="form-control" required value="<?php echo $_SESSION['AdminNom']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuApellido" class="col-sm-4 col-form-label">Apellido:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="AdminApel" name="AdminApel" class="form-control" required value="<?php echo $_SESSION['AdminApel']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuTelefono" class="col-sm-4 col-form-label">Número de teléfono:</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="AdminTel" name="AdminTel" class="form-control" required value="<?php echo $_SESSION['AdminTel']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuCorreo" class="col-sm-4 col-form-label">Correo electrónico:</label>
                                    <div class="col-sm-8">
                                        <input type="email" id="AdminCorreo" name="AdminCorreo" class="form-control" required value="<?php echo $_SESSION['AdminCorreo']; ?>" readonly>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="UsuContra" class="col-sm-4 col-form-label">Contraseña:</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="AdminContra" name="AdminContra" class="form-control" required value="<?php echo $_SESSION['AdminContra']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="confirmarContra" class="col-sm-4 col-form-label">Confirmar Contraseña:</label>
                                    <div class="col-sm-8">
                                        <input type="password" id="confirmarContra" name="confirmarContra" class="form-control" required value="<?php echo $_SESSION['AdminContra']; ?>">
                                        <span></span>
                                    </div>
                                </div>
                                <input type="hidden" name="Estado" value="<?php echo $_SESSION["Estado"]; ?>">
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