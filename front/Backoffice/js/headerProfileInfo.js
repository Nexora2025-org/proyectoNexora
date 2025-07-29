document.addEventListener("DOMContentLoaded", () => {
  const user = JSON.parse(sessionStorage.getItem("user"))
  console.log(user)
  if (user) {
    const profilePic = document.querySelector(".profilePic")
    profilePic.src = `../../../back/user_images/${user.imagen}`
    const userName = document.getElementById("userName")
    userName.textContent = `${user.nombre} ${user.apellido}`
  }else{
    window.location.href = "../login.html"
  }
})
function logout() {
    Swal.fire({
        title: "¿Estas seguro de cerrar sesion?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            sessionStorage.removeItem("userLoggedIn");
            sessionStorage.removeItem("userCI");
            sessionStorage.removeItem("user");
            window.location.href = "../login.html";
        }
    });
}