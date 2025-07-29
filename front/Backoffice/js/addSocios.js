const ciText      =     document.getElementById("ci")
const nameText    =     document.getElementById("name")
const surnameText =     document.getElementById("surname")
const emailText   =     document.getElementById("email")
const phoneText   =     document.getElementById("phone")
const addressText =     document.getElementById("address") 
const mensualidadText = document.getElementById("mensualidad")
const addSocioBtn =     document.getElementById("addSocioBtn")
const deleteAgendaBtn = document.getElementById("deleteAgendaBtn")
const cancelBtn   =     document.getElementById("cancelBtn")
let userToAdd     =     {}
let isEditingAgenda =   false 

document.addEventListener("DOMContentLoaded", () => {
  try {
    const storedUserToAdd = sessionStorage.getItem("userToAdd")

    if (storedUserToAdd) {
      userToAdd = JSON.parse(storedUserToAdd)

      isEditingAgenda = true
      ciText.value = userToAdd.CI
      nameText.value = userToAdd.nombre
      surnameText.value = userToAdd.apellido
      emailText.value = userToAdd.email
      phoneText.value = userToAdd.telefono

      deleteAgendaBtn.style.display = "inline-flex" 
    } else {
     
      ciText.disabled = false
      emailText.disabled = false
      deleteAgendaBtn.style.display = "none" 
    }
  } catch (err) {
    console.error("Error parsing user data:", err)
   
    ciText.disabled = false
    emailText.disabled = false
    deleteAgendaBtn.style.display = "none"
  }


  addSocioBtn.addEventListener("click", addSocio)
  deleteAgendaBtn.addEventListener("click", deleteAgenda)
  cancelBtn.addEventListener("click", cancelAndGoBack)
})

async function addSocio() {
  const ci = ciText.value
  const nombre = nameText.value
  const apellido = surnameText.value
  const email = emailText.value
  const telefono = phoneText.value
  const direccion = addressText.value 
  const mensualidad = mensualidadText.value
  if (!ci || !nombre || !apellido || !email || !telefono || !direccion || !mensualidad) {
     swal.fire({
        position: "top-end",
        icon: "warning",
        title: "Por favor, complete todos los campos",
        showConfirmButton: false,
        timer: 1500,
        backdrop: false,
      })
    return
  }
  try {
    const socioData = {
      CI: ci,
      nombre: nombre,
      apellido: apellido,
      email: email,
      telefono: telefono,
      direccion: direccion,
      pago_mensual: mensualidad,
      estado_pago: "Pendiente",
      comprobante_pago_inicial: null,
      rol: "Socio"
    }
    const res = await fetch("http://localhost/Cooperativa/back/API/api.php/addUsuario", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(socioData),
    });

    const data = await res.json();

    if (data.success) {
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Socio agregado exitosamente!",
        showConfirmButton: false,
        timer: 1500,
        backdrop: false,
      })

      if (isEditingAgenda && userToAdd.CI) {

        await ChangeAgendaEntry(userToAdd.CI)
      }
      sessionStorage.removeItem("userToAdd") 
      setTimeout(() => {
        window.location.href = "agenda.html"
      }, 1600) 
    } else {
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: data.message || "Error al agregar socio.",
        showConfirmButton: false,
        timer: 1500,
        backdrop: false,
      })
    }
  } catch (error) {

    console.error("Error al agregar socio:", error);
    swal.fire({
      position: "top-end",
      icon: "error",
      title: "Error de conexión al servidor. ",
      showConfirmButton: false,
      timer: 1500,
      backdrop: false,
    })
  }
}
 async function deleteAgenda() {
  if (!isEditingAgenda || !userToAdd.CI) {
    swal.fire({
      position: "top-end",
      icon: "warning",
      title: "No hay cita agendada para eliminar.",
      showConfirmButton: false,
      timer: 1500,
      backdrop: false,
    })
    return
  }

  swal.fire({
    title: "¿Estás seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sí, eliminar!",
    cancelButtonText: "Cancelar",
  }).then(async (result) => {
    if (result.isConfirmed) {
      try {
        await deleteAgendaEntry(userToAdd.CI)
        sessionStorage.removeItem("userToAdd") 
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Cita eliminada exitosamente!",
          showConfirmButton: false,
          timer: 1500,
          backdrop: false,
        })
        setTimeout(() => {
          window.location.href = "agenda.html"
        }, 1600)
      } catch (error) {
        console.error("Error al eliminar cita:", error)
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Error al eliminar cita.",
          showConfirmButton: false,
          timer: 1500,
          backdrop: false,
        })
      }
    }
  })
}

async function ChangeAgendaEntry(CI) {
  const res = await fetch(`http://localhost/Cooperativa/back/API/api.php/actualizarAgenda`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      CI: CI,
      estado_agenda: "realizada",
    }),
  })
  const data = await res.json()
  if (!data.success) {
    throw new Error(data.message || "Fallo al actualizar la cita.")
  }
  return data
}
async function deleteAgendaEntry(agendaCI) {
  const res = await fetch(`http://localhost/Cooperativa/back/API/api.php/agendas/${agendaCI}`, {
    method: "DELETE",
  })
  const data = await res.json()
  if (!data.success) {
    throw new Error(data.message || "Failed to delete agenda entry.")
  }
  return data
}

function cancelAndGoBack() {
  window.location.href = "agenda.html"
  sessionStorage.removeItem("userToAdd") 
}
