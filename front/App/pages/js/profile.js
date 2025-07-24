const user = JSON.parse(sessionStorage.getItem("user"))
const userData = [user.CI, user.nombre, user.email, user.telefono, user.direccion]
document.addEventListener("DOMContentLoaded", () => {

  if (!sessionStorage.getItem("userLoggedIn")) {
    window.location.href = "login.html"
    return
  }

  const editButton = document.getElementById("editButton");
  const editMenu = document.querySelector(".edit-actions");
  const closeMenu = document.querySelector(".cancel-button");
  const saveInfo = document.querySelector(".save-button");

  console.log(user);
  const ciText = document.querySelector(".user-ci");
  ciText.textContent = user.CI;
  const nameText = document.querySelector(".user-name");
  nameText.textContent = user.nombre;
  const emailText = document.querySelector(".user-email");
  emailText.textContent = user.email;
  const phoneText = document.querySelector(".user-phone");
  phoneText.textContent = user.telefono;
  const addressText = document.querySelector(".user-address");
  addressText.textContent = user.direccion;
  const DataInputs = document.querySelectorAll(".edit-input");


  DataInputs.forEach((input, index) => {
    input.value = userData[index];
  })

  editButton.addEventListener("click", () => {
    editMenu.classList.add("show-edit-actions");
  });

  closeMenu.addEventListener("click", () => {
    editMenu.classList.remove("show-edit-actions");
  });
  saveInfo.addEventListener("click", saveChangedInfo);
})

async function saveChangedInfo() {
  const DataInputs = document.querySelectorAll(".edit-input");

  const updatedUser = {
    ci: DataInputs[0].value,
    nombre: DataInputs[1].value,
    email: DataInputs[2].value,
    telefono: DataInputs[3].value,
    direccion: DataInputs[4].value
  };

  try {
    const response = await fetch("http://localhost/Cooperativa/back/API/api.php/actualizarInfo", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(updatedUser)
    });

    const result = await response.json();
    console.log(result);
    if (result.success) {
    
      sessionStorage.setItem("user", JSON.stringify(result.user));

      // Actualizar elementos en pantalla
      document.querySelector(".user-ci").textContent = result.user.CI;
      document.querySelector(".user-name").textContent = result.user.Nombre;
      document.querySelector(".user-email").textContent = result.user.email;
      document.querySelector(".user-phone").textContent = result.user.Telefono;
      document.querySelector(".user-address").textContent = result.user.Direccion;

      // Cerrar el modal
      const editMenu = document.querySelector(".edit-actions");
      editMenu.classList.remove("show-edit-actions");
      editMenu.classList.add("hidden");

      console.log("✅ Información actualizada con éxito.");
    } else {
      console.error("❌ No se pudo actualizar el usuario.");
    }

  } catch (error) {
    console.error("❌ Error en la solicitud:", error);
  }
}