document.addEventListener("DOMContentLoaded", function () {
    // Formulario de Registro
    const registroForm = document.getElementById("registroForm");
  
      
    // Evento para validar el formulario de registro al intentar enviarlo
    registroForm.addEventListener("submit", function (e) {
      e.preventDefault(); // Evitar el envío del formulario
  
      // Validar todos los campos individualmente
      const isValidDocumento = validateDocumentoField({ target: documentoField });
      const isValidNombre = validateNombreField({ target: nombreField });
      const isValidApellido = validateApellidoField({ target: apellidoField });
      const isValidCorreo = validateCorreoField({ target: correoField });
      const isValidTelefono = validateTelefonoField({ target: telefonoField });
      const isValidContraseña = validateContraseñaFields();
  
      // Si todos los campos son válidos, enviar el formulario
      if (
        isValidDocumento &&
        isValidNombre &&
        isValidApellido &&
        isValidCorreo &&
        isValidTelefono &&
        isValidContraseña
      ) {
        registroForm.submit();
      }
    });
  
    //-----------------------------------------VALIDAR DOCUMENTO-----------------------------------------
    const documentoField = document.querySelector("#UsuId, #FunId");
  
    documentoField.addEventListener("input", validateDocumentoField);
    documentoField.addEventListener("blur", validateDocumentoField);
  
    function validateDocumentoField(e) {
      const field = e.target;
      const fieldValue = field.value;
      const errorSpan = field.nextElementSibling;
      let isValid = true;
  
      // Verificar si el campo está vacío
      if (fieldValue.trim() === "") {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        errorSpan.innerText = "Este campo es obligatorio";
        isValid = false;
      } else {
        // Eliminar caracteres no numéricos
        const filteredValue = fieldValue.replace(/\D/g, "");
        if (fieldValue !== filteredValue) {
          field.value = filteredValue;
        }
  
        // Verificar longitud mínima
        if (filteredValue.length <= 5) {
          field.classList.add("invalid");
          errorSpan.classList.add("error");
          errorSpan.innerText =
            "Digite un número de cédula válido (mínimo 6 dígitos)";
          isValid = false;
        } else {
          field.classList.remove("invalid");
          errorSpan.classList.remove("error");
          errorSpan.innerText = "";
        }
      }
  
      return isValid;
    }
  
    //-----------------------------------------VALIDAR NOMBRE-----------------------------------------
    const nombreField = document.querySelector("#UsuNombre, #FunNombre ");
  
    nombreField.addEventListener("input", validateNombreField);
    nombreField.addEventListener("blur", validateNombreField);
  
    function validateNombreField(e) {
      const field = e.target;
      const fieldValue = field.value.trim(); // Trim para eliminar espacios en blanco al inicio y al final
      const errorSpan = field.nextElementSibling;
      let isValid = true;
  
      // Expresión regular para validar que solo contenga letras y espacios
      const regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
  
      // Verificar si el campo está vacío, tiene menos de dos caracteres o contiene caracteres no permitidos
      if (
        fieldValue === "" ||
        fieldValue.length < 2 ||
        !regex.test(fieldValue)
      ) {
        isValid = false;
      }
  
      // Actualizar clases y mensaje de error
      if (!isValid) {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        if (fieldValue === "") {
          errorSpan.innerText = "Este campo es obligatorio";
        } else if (fieldValue.length < 2) {
          errorSpan.innerText = "Debe tener al menos dos caracteres";
        } else {
          errorSpan.innerText = "Ingrese solo letras y espacios";
        }
      } else {
        field.classList.remove("invalid");
        errorSpan.classList.remove("error");
        errorSpan.innerText = "";
      }
  
      return isValid;
    }
  
    //-----------------------------------------VALIDAR APELLIDO-----------------------------------------
    const apellidoField = document.querySelector("#UsuApellido, #FunApellido");
  
    apellidoField.addEventListener("input", validateApellidoField);
    apellidoField.addEventListener("blur", validateApellidoField);
  
    function validateApellidoField(e) {
      const field = e.target;
      const fieldValue = field.value.trim(); // Trim para eliminar espacios en blanco al inicio y al final
      const errorSpan = field.nextElementSibling;
      let isValid = true;
  
      // Expresión regular para validar que solo contenga letras y espacios
      const regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
  
      // Verificar si el campo está vacío, tiene menos de dos caracteres o contiene caracteres no permitidos
      if (
        fieldValue === "" ||
        fieldValue.length < 2 ||
        !regex.test(fieldValue)
      ) {
        isValid = false;
      }
  
      // Actualizar clases y mensaje de error
      if (!isValid) {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        if (fieldValue === "") {
          errorSpan.innerText = "Este campo es obligatorio";
        } else if (fieldValue.length < 2) {
          errorSpan.innerText = "Debe tener al menos dos caracteres";
        } else {
          errorSpan.innerText = "Ingrese solo letras y espacios";
        }
      } else {
        field.classList.remove("invalid");
        errorSpan.classList.remove("error");
        errorSpan.innerText = "";
      }
  
      return isValid;
    }
  
    //-----------------------------------------VALIDAR CORREO-----------------------------------------
    const correoField = document.querySelector("#UsuCorreo, #FunCorreo");
  
    correoField.addEventListener("input", validateCorreoField);
    correoField.addEventListener("blur", validateCorreoField);
  
    function validateCorreoField(e) {
      const field = e.target;
      const fieldValue = field.value;
      const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      const errorSpan = field.nextElementSibling;
      let isValid = true;
  
      // Verificar si el campo está vacío
      if (fieldValue.trim() === "") {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        errorSpan.innerText = "Este campo es obligatorio";
        isValid = false;
        // Verificar formato del correo electrónico
      } else if (!correoRegex.test(fieldValue)) {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        errorSpan.innerText = "Correo electrónico no válido";
        isValid = false;
      } else {
        field.classList.remove("invalid");
        errorSpan.classList.remove("error");
        errorSpan.innerText = "";
      }
  
      return isValid;
    }
  
    //-----------------------------------------VALIDAR TELEFONO-----------------------------------------
    const telefonoField = document.querySelector("#UsuTelefono, #FunTelefono");
  
    telefonoField.addEventListener("input", validateTelefonoField);
    telefonoField.addEventListener("blur", validateTelefonoField);
  
    function validateTelefonoField(e) {
      const field = e.target;
      let fieldValue = field.value.trim();
      const errorSpan = field.nextElementSibling;
      let isValid = true;
      let errorMessage = "";
  
      // Verificar si el campo está vacío
      if (fieldValue === "") {
        errorMessage = "Este campo es obligatorio";
        isValid = false;
      } else {
        // Eliminar cualquier carácter que no sea número
        fieldValue = fieldValue.replace(/\D/g, "");
  
        // Verificar longitud exacta
        if (fieldValue.length !== 10) {
          errorMessage = "El teléfono debe tener exactamente 10 dígitos";
          isValid = false;
        }
  
        // Verificar que el primer dígito sea 3
        if (fieldValue.charAt(0) !== "3") {
          errorMessage = "El primer dígito debe ser 3";
          isValid = false;
        }
      }
  
      // Validar si hay mensaje de error
      if (errorMessage !== "") {
        field.classList.add("invalid");
        errorSpan.classList.add("error");
        errorSpan.innerText = errorMessage;
      } else {
        field.classList.remove("invalid");
        errorSpan.classList.remove("error");
        errorSpan.innerText = "";
      }
  
      // Actualizar el valor del campo con el valor filtrado
      field.value = fieldValue;
  
      return isValid;
    }
  
    //-----------------------------------------VALIDAR CONTRASEÑA-----------------------------------------
    const contraseñaField = document.querySelector("#Usucontra, #FunContrasena");
    const confirmarContraseñaField = document.querySelector("#confirmarContra");
  
    contraseñaField.addEventListener("input", validateContraseñaFields);
    confirmarContraseñaField.addEventListener("input", validateContraseñaFields);
  
    function validateContraseñaFields() {
      const contraseñaValue = contraseñaField.value.trim();
      const confirmarContraseñaValue = confirmarContraseñaField.value.trim();
      const contraseñaErrorSpan = contraseñaField.nextElementSibling;
      const confirmarContraseñaErrorSpan =
        confirmarContraseñaField.nextElementSibling;
  
      let contraseñaValid = true;
      let confirmarContraseñaValid = true;
  
      // Validación de la contraseña
      if (contraseñaValue === "") {
        contraseñaField.classList.add("invalid");
        contraseñaErrorSpan.classList.add("error");
        contraseñaErrorSpan.innerText = "Este campo es obligatorio";
        contraseñaValid = false;
    } else if (contraseñaValue.length < 7) {
      contraseñaField.classList.add("invalid");
      contraseñaErrorSpan.classList.add("error");
      contraseñaErrorSpan.innerText =
        "La Contraseña debe tener al menos 7 caracteres";
      contraseñaValid = false;
    } else if (
      !/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+/.test(
        contraseñaValue
      )
    ) {
      contraseñaField.classList.add("invalid");
      contraseñaErrorSpan.classList.add("error");
      contraseñaErrorSpan.innerText =
        "La Contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial";
      contraseñaValid = false;
    } else {
      contraseñaField.classList.remove("invalid");
      contraseñaErrorSpan.classList.remove("error");
      contraseñaErrorSpan.innerText = "";
    }

    // Validación de confirmar contraseña
    if (confirmarContraseñaValue === "") {
      confirmarContraseñaField.classList.add("invalid");
      confirmarContraseñaErrorSpan.classList.add("error");
      confirmarContraseñaErrorSpan.innerText = "Este campo es obligatorio";
      confirmarContraseñaValid = false;
    } else if (confirmarContraseñaValue !== contraseñaValue) {
      confirmarContraseñaField.classList.add("invalid");
      confirmarContraseñaErrorSpan.classList.add("error");
      confirmarContraseñaErrorSpan.innerText = "Las contraseñas no coinciden";
      confirmarContraseñaValid = false;
    } else {
      confirmarContraseñaField.classList.remove("invalid");
      confirmarContraseñaErrorSpan.classList.remove("error");
      confirmarContraseñaErrorSpan.innerText = "";
    }

    return contraseñaValid && confirmarContraseñaValid;
  }

  //-----------------------------------------FIN DE VALIDACIÓN Y ENVÍO DE FORMULARIO-----------------------------------------

});
  