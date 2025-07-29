

document.addEventListener("DOMContentLoaded", () => {
  let user = JSON.parse(sessionStorage.getItem("user"))
  let userData = [];
  try {
   userData = [user.CI, user.nombre, user.email, user.telefono, user.direccion]
} catch (error) {
  window.location.href = "../login.html"
}
  if (!userData) {
    window.location.href = "../login.html"
    return
  }

 
  user = JSON.parse(sessionStorage.getItem("user"))
  document.getElementById("userName").textContent = user.nombre


  loadDashboardStats()
  loadRecentActivity()
  loadUpcomingEvents()
})

function loadDashboardStats() {

  const stats = {
    totalSocios: 45,
    totalRecaudado: 10,
    jornadasMes: 8,
    viviendasAsignadas: 12,
  }

  document.getElementById("totalSocios").textContent = stats.totalSocios
  document.getElementById("totalRecaudado").textContent = `$${stats.totalRecaudado.toLocaleString()}`
  document.getElementById("jornadasMes").textContent = stats.jornadasMes
  document.getElementById("viviendasAsignadas").textContent = stats.viviendasAsignadas
}

function loadRecentActivity() {
  const activities = [
    { text: "Juan Pérez realizó pago de cuota mensual", time: "2 horas ago" },
    { text: "Nueva jornada de trabajo programada", time: "4 horas ago" },
    { text: "María González actualizó su información", time: "1 día ago" },
    { text: "Vivienda #15 asignada a Carlos Ruiz", time: "2 días ago" },
  ]

  const activityList = document.getElementById("activityList")
  activityList.innerHTML = activities
    .map(
      (activity) => `
        <div class="activity-item">
            <p>${activity.text}</p>
            <small>${activity.time}</small>
        </div>
    `,
    )
    .join("")
}

function loadUpcomingEvents() {
  const events = [
    { title: "Jornada de Construcción", date: "2024-03-15", time: "08:00" },
    { title: "Asamblea General", date: "2024-03-20", time: "19:00" },
    { title: "Taller de Capacitación", date: "2024-03-25", time: "14:00" },
  ]

  const eventsContainer = document.getElementById("upcomingEvents")
  eventsContainer.innerHTML = events
    .map(
      (event) => `
        <div class="event-item">
            <h4>${event.title}</h4>
            <p>${event.date} - ${event.time}</p>
        </div>
    `,
    )
    .join("")
}

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar")
  sidebar.classList.toggle("active")
}



document.addEventListener("click", (e) => {
  const sidebar = document.getElementById("sidebar")
  const menuToggle = document.querySelector(".menu-toggle")

  if (
    window.innerWidth <= 768 &&
    !sidebar.contains(e.target) &&
    !menuToggle.contains(e.target) &&
    sidebar.classList.contains("active")
  ) {
    sidebar.classList.remove("active")
  }
})
