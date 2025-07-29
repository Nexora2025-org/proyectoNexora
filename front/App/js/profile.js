const ciText = document.querySelector(".user-ci")
const nameText = document.querySelector(".user-name")
const surnameText = document.querySelector(".user-surname")
const emailText = document.querySelector(".user-email")
const editionstatus = document.querySelector(".edition-status")
const phoneText = document.querySelector(".user-phone")

const addressText = document.querySelector(".user-address")
const DataInputs = document.querySelectorAll(".edit-input")
const shadowOverlay = document.getElementById("overlay")
const paymentStatus = document.querySelector(".user-payment-status")
const uploadImage = document.querySelector(".upload-image")
  const profileImage = document.getElementById("profileImage")
//Instancias del documento para estilar
const spinner = document.getElementById("loadingSpinner")
const userRol = document.querySelector(".user-role")
spinner.style.display = "none"

document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(sessionStorage.getItem("user"))
  let userData = []
  try {
    userData = [user.CI, user.nombre, user.estado_pago, user.apellido, user.email, user.telefono, user.direccion]
  } catch (error) {
    window.location.href = "../login.html"
  }

  if (!user) {
    window.location.href = "../login.html"
    return
  }

  console.log(user)
  document.getElementById("userName").textContent = user.nombre

  // Inicializar la imagen de perfil
  initializeProfileImage(user)

  const editButton = document.getElementById("editButton")
  const editMenu = document.querySelector(".edit-actions")
  const closeMenu = document.querySelector(".cancel-button")
  const saveInfo = document.querySelector(".save-button")

  console.log(user)

  ciText.textContent = user.CI
  userRol.textContent = user.rol
  nameText.textContent = user.nombre

  surnameText.textContent = user.apellido
  emailText.textContent = user.email
  phoneText.textContent = user.telefono
  paymentStatus.textContent = user.estado_pago
  if (user.estado_pago === "Pagado") {
    paymentStatus.style.color = "green"
  }
  if (user.estado_pago === "Pendiente") {
    paymentStatus.style.color = "orange"
  } else {
    paymentStatus.style.color = "red"
  }
  addressText.textContent = user.direccion

  DataInputs.forEach((input, index) => {
    input.value = userData[index]
  })

  editButton.addEventListener("click", () => {
    editMenu.classList.add("show-edit-actions")
    shadowOverlay.style.display = "block"
  })

  closeMenu.addEventListener("click", () => {
    editMenu.classList.remove("show-edit-actions")
    shadowOverlay.style.display = "none"
  })
  saveInfo.addEventListener("click", saveChangedInfo)
  // Agregar event listener para el formulario de imagen
  const uploadForm = document.getElementById("uploadForm")
  if (uploadForm) {
    uploadForm.addEventListener("submit", handleImageUpload)
  }

  // Event listener para preview de imagen
  const profileImageInput = document.getElementById("profile_image")
  if (profileImageInput) {
    profileImageInput.addEventListener("change", previewImage)
  }
})


async function saveChangedInfo() {
  const DataInputs = document.querySelectorAll(".edit-input")
  spinner.style.display = "block"

  const updatedUser = {
    CI: DataInputs[0].value,
    nombre: DataInputs[1].value,
    apellido: DataInputs[2].value,
    email: DataInputs[3].value,
    telefono: DataInputs[4].value,
    direccion: DataInputs[5].value,
  }

  try {
    const response = await fetch("http://localhost/Cooperativa/back/API/api.php/actualizarInfo", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(updatedUser),
    })

    if (!response.ok) {
      throw new Error("Error en la solicitud HTTP")
    }

    const result = await response.json()

    if (result.success) {
      // Actualizar sessionStorage
      sessionStorage.setItem("user", JSON.stringify(result.user))

      // Actualizar el DOM para que se reflejen los cambios
      const user = JSON.parse(sessionStorage.getItem("user"))
      ciText.textContent = user.CI
      nameText.textContent = user.nombre
      surnameText.textContent = user.apellido
      emailText.textContent = user.email
      phoneText.textContent = user.telefono
      addressText.textContent = user.direccion
      document.getElementById("userName").textContent = user.nombre
      // Cerrar el modal de edicion
      const editMenu = document.querySelector(".edit-actions")
      editMenu.classList.remove("show-edit-actions")
      editionstatus.style.color = "green"
      editionstatus.textContent = "Información actualizada con exito"
    } else {
      editionstatus.style.color = "red"
      editionstatus.textContent = "Error al actualizar la información"
    }
    setTimeout(() => {
      editionstatus.textContent = ""
      spinner.style.display = "none"
    }, 3000)
    shadowOverlay.style.display = "none"
  } catch (error) {
    editionstatus.style.color = "red"
    editionstatus.textContent = "Error al actualizar la información"

    console.error("❌ Error en la solicitud:", error)
  }
}

function initializeProfileImage(user) {
  const defaultImagePath = "../../../back/user_images/default/default-avatar.svg";
  if (user.imagen && user.imagen !== "") {
    // Añado un parámetro único para evitar que carge del caché y siempre se actualice bien la imagen con un query string que no afecta el archivo directamente pero hace que el navegador no carge de la cache
    const timestamp = new Date().getTime();
    profileImage.src = `../../../back/user_images/${user.imagen}?t=${timestamp}`;
    profileImage.alt = "Foto de perfil de " + user.nombre;
  } else {
    profileImage.src = defaultImagePath;
    profileImage.alt = "Foto de perfil por defecto";
  }


profileImage.onerror = function () {
  if (!profileImage.src.includes("default-avatar.svg")) {
    profileImage.src = defaultImagePath;
    profileImage.alt = "Foto de perfil por defecto";
  }
};
}



function previewImage(event) {
  const file = event.target.files[0]

  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      profileImage.src = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

async function handleImageUpload(event) {
  event.preventDefault()

  const fileInput = document.getElementById("profile_image")
  const file = fileInput.files[0]

  if (!file) {
    alert("Por favor selecciona una imagen")
    return
  }

  const user = JSON.parse(sessionStorage.getItem("user"))
  const formData = new FormData()
  formData.append("profile_image", file)
  formData.append("user_ci", user.CI)

  spinner.style.display = "block"

  try {
    const response = await fetch("http://localhost/Cooperativa/back/API/api.php/uploadImage", {
      method: "POST",
      body: formData,
    })

    const result = await response.json()

    if (result.status === "success") {
      // Actualizar sessionStorage con el usuario actualizado
      sessionStorage.setItem("user", JSON.stringify(result.user))
 
  
      editionstatus.style.color = "green"
      editionstatus.textContent = "Imagen actualizada con éxito"
      initializeProfileImage(result.user)

      fileInput.value = ""
    } else {
      editionstatus.style.color = "red"
      editionstatus.textContent = result.message || "Error al subir la imagen"
    }
  } catch (error) {
    console.error("Error:", error)
    editionstatus.style.color = "red"
    editionstatus.textContent = "Error de conexión al subir la imagen "  + error
  } finally {
    spinner.style.display = "none"
    setTimeout(() => {
      editionstatus.textContent = ""
      
    }, 3000)
  }
}
