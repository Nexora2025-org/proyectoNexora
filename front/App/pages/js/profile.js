const ciText = document.querySelector(".user-ci");
const nameText = document.querySelector(".user-name");
const surnameText = document.querySelector(".user-surname");
const emailText = document.querySelector(".user-email");
const editionstatus = document.querySelector(".edition-status");
const phoneText = document.querySelector(".user-phone");

const addressText = document.querySelector(".user-address");
const DataInputs = document.querySelectorAll(".edit-input");
const shadowOverlay =  document.getElementById("overlay")
const paymentStatus = document.querySelector(".user-payment-status")

//Instancias del documento para estilar
const spinner = document.getElementById("loadingSpinner");
const userRol = document.querySelector(".user-role");
spinner.style.display = "none";

document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(sessionStorage.getItem("user"))
  let userData = [];
  try {
    userData = [user.CI, user.nombre, user.apellido, user.email, user.telefono, user.direccion]
  } catch (error) {
    window.location.href = "../login.html"
  }

  if (!user) {
    window.location.href = "../login.html"
    return
  }
  console.log(user);
   document.getElementById("userName").textContent = user.nombre
  const editButton = document.getElementById("editButton");
  const editMenu = document.querySelector(".edit-actions");
  const closeMenu = document.querySelector(".cancel-button");
  const saveInfo = document.querySelector(".save-button");

  console.log(user);

  ciText.textContent = user.CI;
  userRol.textContent = user.rol;
  nameText.textContent = user.nombre;
  
  surnameText.textContent = user.apellido;
  emailText.textContent = user.email;
  phoneText.textContent = user.telefono;
  paymentStatus.textContent = user.estado_pago_inicial
  if(user.estado_pago_inicial === "Pagado"){
    paymentStatus.style.color = "green";
  }
  if(user.estado_pago_inicial === "Pendiente"){
    paymentStatus.style.color = "orange";
  }else{
    paymentStatus.style.color = "red";
  }
  addressText.textContent = user.direccion;
  


  DataInputs.forEach((input, index) => {
    input.value = userData[index];
  })

  editButton.addEventListener("click", () => {
    editMenu.classList.add("show-edit-actions");
    shadowOverlay.style.display = "block";
  });

  closeMenu.addEventListener("click", () => {
    editMenu.classList.remove("show-edit-actions");
      shadowOverlay.style.display = "none";
  });
  saveInfo.addEventListener("click", saveChangedInfo);
})
async function saveChangedInfo() {
  const DataInputs = document.querySelectorAll(".edit-input");
  spinner.style.display = "block";

  const updatedUser = {
    CI: DataInputs[0].value,
    nombre: DataInputs[1].value,
    apellido: DataInputs[2].value,
    email: DataInputs[3].value,
    telefono: DataInputs[4].value,
    direccion: DataInputs[5].value
  };

  try {
    const response = await fetch("http://localhost/Cooperativa/back/API/api.php/actualizarInfo", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(updatedUser)
    });

    if (!response.ok) {
      throw new Error("Error en la solicitud HTTP");
    }

    const result = await response.json();

    if (result.success) {
      // Actualizar sessionStorage
      sessionStorage.setItem("user", JSON.stringify(result.user));

      // Actualizar el DOM
      const user = JSON.parse(sessionStorage.getItem("user"));
      ciText.textContent = user.CI;
      nameText.textContent = user.nombre;
      surnameText.textContent = user.apellido;
      emailText.textContent = user.email;
      phoneText.textContent = user.telefono;
      addressText.textContent = user.direccion;
         document.getElementById("userName").textContent = user.nombre
      // Cerrar el modal
      const editMenu = document.querySelector(".edit-actions");
      editMenu.classList.remove("show-edit-actions");
      editionstatus.style.color = "green";
      editionstatus.textContent = "Información actualizada con exito";
    } else {
      editionstatus.style.color = "red";
      editionstatus.textContent = "Error al actualizar la información";
    }
    setTimeout(() => {
      editionstatus.textContent = "";
      spinner.style.display = "none";
    }, 3000);
       shadowOverlay.style.display = "none";
  } catch (error) {
     editionstatus.style.color = "red";
      editionstatus.textContent = "Error al actualizar la información";
      
    console.error("❌ Error en la solicitud:", error);
  } 
  
}