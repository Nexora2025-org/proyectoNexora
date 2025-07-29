document.addEventListener("DOMContentLoaded", () => {
    const user = JSON.parse(sessionStorage.getItem("user"))
    const profilePic = document.querySelector(".profilePic");
    if (user) {
        profilePic.src = user.imagen ? `../../../back/user_images/${user.imagen}` : `../../../back/user_images/default/default-avatar.svg`;
  
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