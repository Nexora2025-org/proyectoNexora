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
      return;
    }
    const response =await validateLogin(ci, password);
    if (response) {
      sessionStorage.setItem("userLoggedIn", "true");
      sessionStorage.setItem("userCI", ci);
      sessionStorage.setItem("user", JSON.stringify(response));
      window.location.href = "./pages/agenda.html";
    } else {
        Swal.fire({
        position: "top-end",
        icon: "warning",
        title: "Usuario no administrador",
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
    const adminRoles=[
      'tesorero',
      'directivo',
      'presidente',
      'secretario'
    ]
     return adminRoles.includes(data.user.rol.toLowerCase()) ? data.user : false;
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
/*
{
    [
      {
        "id": 1,
        "usr_name": "admin",
        "usr_email": "admin",
        "usr_pass": "admin",
        "imagen": null
      },
      {
        "id": 2,
        "usr_name": "user",
        "usr_email": "user",
        "usr_pass": "user",
        "imagen": null
      }

    ]
}



*/