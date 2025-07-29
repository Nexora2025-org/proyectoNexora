
const agendaTable = document.getElementById("citasTableBody")
let agendas = []

document.addEventListener("DOMContentLoaded", () => {
  fetchAgendas()
  setInterval(fetchAgendas, 5000)
})

async function fetchAgendas() {
  try {
    const res = await fetch("http://localhost/Cooperativa/back/API/api.php/agendas")
    agendas = await res.json()
    agendas = agendas.agendas
    agendaTable.innerHTML = ""
    console.log(agendas)
    agendas.forEach((agenda) => {
      const row = document.createElement("tr")

      // Crea una fila con datos
      if (agenda.estado_agenda === "pendiente") {
         row.innerHTML = `
        <td>${agenda.CI}</td>
        <td>${agenda.email}</td>
        <td>${agenda.nombre}</td>
        <td>${agenda.apellido}</td>
        <td>${agenda.telefono}</td>
        <td>${agenda.fecha_agendada}</td>
        <td>${agenda.hora}</td>
        <td class="status-${agenda.estado_agenda}"><p>${agenda.estado_agenda}</p></td>
        <td>
          <a href="addSocio.html" class="addSocioLink" data-agenda='${JSON.stringify(agenda)}'>
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
        </td>
      `
      } else {
         row.innerHTML = `
        <td>${agenda.CI}</td>
        <td>${agenda.email}</td>
        <td>${agenda.nombre}</td>
        <td>${agenda.apellido}</td>
        <td>${agenda.telefono}</td>
        <td>${agenda.fecha_agendada}</td>
        <td>${agenda.hora}</td>
        <td class="status-${agenda.estado_agenda}"><p>${agenda.estado_agenda}</p></td>
        <td>
          <button class="deleteAgenda" onclick="deleteAgenda()" data-agenda='${JSON.stringify(agenda)}'>
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      `
      } 
      agendaTable.appendChild(row)
    })

    document.querySelectorAll(".addSocioLink").forEach((link) => {
      link.addEventListener("click", function (e) {
        const agendaData = this.getAttribute("data-agenda")
        sessionStorage.setItem("userToAdd", agendaData)
        window.location.href = "addSocio.html"
      })
    })
    document.querySelectorAll(".deleteAgenda").forEach((link) => {
      link.addEventListener("click", function (e) {
        const agendaData = this.getAttribute("data-agenda")
        agendaToDelete = JSON.parse(agendaData)
        deleteAgenda(agendaToDelete)
      })
    })
  } catch (error) {
    console.error("Error al cargar agendas:", error)
  }
}



 async function deleteAgenda(agendaToDelete) {

  if (!agendaToDelete) {
    Swal.fire({
      position: "top-end",
      icon: "warning",
      title: "No hay cita agendada para eliminar.",
      showConfirmButton: false,
      timer: 1500,
      backdrop: false,
    })
    return
  }
  Swal.fire({
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
        await deleteAgendaEntry(agendaToDelete.CI)
        sessionStorage.removeItem("userToAdd") 
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Cita eliminada exitosamente!",
          showConfirmButton: false,
          timer: 1500,
          backdrop: false,
        })
        location.reload()
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
