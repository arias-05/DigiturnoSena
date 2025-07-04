// Función para mostrar el formulario de recuperación de contraseña
function mostrarFormularioRecuperarContraseña(tipoUsuario) {
  if (tipoUsuario === "aprendices") {
    // Ocultar formulario de inicio de sesión de aprendices y mostrar formulario de recuperación
    document.getElementById("formularioInicioSesionAprendices").style.display =
      "none";
    document.getElementById(
      "formularioRecuperarContraseñaAprendices"
    ).style.display = "block";
  } else if (tipoUsuario === "funcionarios") {
    // Ocultar formulario de inicio de sesión de funcionarios y mostrar formulario de recuperación
    document.getElementById(
      "formularioInicioSesionFuncionarios"
    ).style.display = "none";
    document.getElementById(
      "formularioRecuperarContraseñaFuncionarios"
    ).style.display = "block";
  } else if (tipoUsuario === "administradores") {
    // Ocultar formulario de inicio de sesión de administradores y mostrar formulario de recuperación
    document.getElementById(
      "formularioInicioSesionAdministradores"
    ).style.display = "none";
    document.getElementById(
      "formularioRecuperarContraseñaAdministradores"
    ).style.display = "block";
  }
}

// Función para mostrar el formulario de inicio de sesión
function mostrarFormularioInicioSesion(tipoUsuario) {
  if (tipoUsuario === "aprendices") {
    // Mostrar formulario de inicio de sesión de aprendices y ocultar formulario de recuperación
    document.getElementById("formularioInicioSesionAprendices").style.display =
      "block";
    document.getElementById(
      "formularioRecuperarContraseñaAprendices"
    ).style.display = "none";
  } else if (tipoUsuario === "funcionarios") {
    // Mostrar formulario de inicio de sesión de funcionarios y ocultar formulario de recuperación
    document.getElementById(
      "formularioInicioSesionFuncionarios"
    ).style.display = "block";
    document.getElementById(
      "formularioRecuperarContraseñaFuncionarios"
    ).style.display = "none";
  } else if (tipoUsuario === "administradores") {
    // Mostrar formulario de inicio de sesión de administradores y ocultar formulario de recuperación
    document.getElementById(
      "formularioInicioSesionAdministradores"
    ).style.display = "block";
    document.getElementById(
      "formularioRecuperarContraseñaAdministradores"
    ).style.display = "none";
  }
}

//Ver contraseña
function togglePassword(fieldId, toggleId) {
  const passwordField = document.getElementById(fieldId);
  const togglePassword = document.getElementById(toggleId);

  if (passwordField.type === "password") {
      passwordField.type = "text";
      togglePassword.textContent = "Ocultar";
  } else {
      passwordField.type = "password";
      togglePassword.textContent = "Mostrar";
  }
}

document.getElementById("togglePassword1").addEventListener("click", function () {
  togglePassword("UsucontraAprendices", "togglePassword1");
});

document.getElementById("togglePassword2").addEventListener("click", function () {
  togglePassword("FunContrasenaFuncionarios", "togglePassword2");
});

document.getElementById("togglePassword3").addEventListener("click", function () {
  togglePassword("AdminContrasenaAdministradores", "togglePassword3");
});