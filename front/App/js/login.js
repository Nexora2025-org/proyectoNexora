document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");

  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const ci = document.getElementById("ci").value;
    const password = document.getElementById("password").value;

    if (!ci || !password) {
        Swal.fire({
  position: "top-end",
  icon: "warning",
  title: "Por favor, complete todos los campos",
  showConfirmButton: false,
  timer: 1500,
  backdrop: false  
})
      loadingSumbitbutton()
     
      return;
    }

    const response = await validateLogin(ci, password);

    if (response) {
      sessionStorage.setItem("userLoggedIn", "true");
      sessionStorage.setItem("userCI", ci);
      sessionStorage.setItem("user", JSON.stringify(response));
      window.location.href = "./pages/dashboard.html";
    } else {

        Swal.fire({
        position: "top-end",
        icon: "warning",
        title: "Credenciales incorrectas",
        showConfirmButton: false,
        timer: 1500,
        backdrop: false  
      });
   
  
    }
  });
});

async function validateLogin(ci, password) {
  try {
    const res = await fetch('http://localhost/Cooperativa/back/API/api.php/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        usr_ci: ci,
        usr_pass: password
      })
    });

    const data = await res.json();
    return data.success ? data.user : false;  // Ajusta esto según tu backend
  } catch (error) {
    console.error("Error al validar login:", error);
    return false;
  }
}

function showForgotPassword() {
    Swal.fire({
  title: 'Advertencia!',
  text: 'Estamos trabajando en esta funcionalidad',
  icon: 'warning',
  confirmButtonText: 'Cool'
})
}
