const appointmentSelect = document.getElementById('appointment');

window.onload = function () {
  fetch('http://localhost/Cooperativa/back/API/api.php/agendas')
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const fechasOcupadas = data.agendas.map(a => `${a.fecha_agendada} ${a.hora}`);
        console.log(fechasOcupadas);
        const ahora = new Date();
        for (let d = 0; d < 7; d++) { 
          const fechaBase = new Date(ahora);
          fechaBase.setDate(ahora.getDate() + d);

          for (let h = 9; h <= 17; h++) {          
            for (let m = 0; m < 60; m += 30) {       
              const cita = new Date(fechaBase);
              cita.setHours(h, m, 0, 0);

              const fechaSQL = cita.toISOString().slice(0, 10); 
              const horaSQL = cita.toTimeString().slice(0, 8); 
              const clave = `${fechaSQL} ${horaSQL}`;
              
       
              if (!fechasOcupadas.includes(clave)) {
                const horaVisible = horaSQL.slice(0,5); 
                const label = `${fechaSQL} - ${horaVisible}`;
                const option = document.createElement("option");
                option.value = clave;
                option.textContent = label;
                appointmentSelect.appendChild(option);
              }else{
             
                 const horaVisible = horaSQL.slice(0,5); 
                const label = `${fechaSQL} - ${horaVisible} (CITA OCUPADA)`;
                const option = document.createElement("option");
                option.value = clave;
                option.textContent = label;
                option.disabled = true;
                appointmentSelect.appendChild(option);
              }
            }
          }
        }

        appointmentSelect.disabled = false;
      } else {
        console.error("No se pudieron cargar las agendas.");
      }
    })
    .catch(error => {
      console.error('Error en fetch:', error);
    });
};
appointmentSelect.addEventListener('input', () => {
  const selectedValue = appointmentSelect.value;
  if(selectedValue.includes("OCUPADA")){
    alert("Cita ocupada");
  }
});
document.getElementById('contact-form').addEventListener('submit', event => {
  event.preventDefault();

const ciInput = document.getElementById('CI');
const nameInput = document.getElementById('name');
const surnameInput = document.getElementById('surname');
const emailInput = document.getElementById('email');
const phoneInput = document.getElementById('phone');
const birthdateInput = document.getElementById('birthdate');
const appointmentInput = document.getElementById('appointment');

const data = {
  CI: ciInput.value,
  nombre: nameInput.value,
  apellido: surnameInput.value,
  email: emailInput.value,
  telefono: phoneInput.value,
  fecha_nacimiento: birthdateInput.value,
  fecha_agendada: new Date().toISOString().split('T')[0],
  hora: appointmentInput.value
};

  fetch('http://localhost/Cooperativa/back/API/api.php/Setappointment', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
         Swal.fire({
          title: 'Cita agendada',
           text: 'Tu cita ha sido agendada',
          icon: 'success',
         confirmButtonText: 'Cerrar'
         })
   
      } else {
        Swal.fire({
          title: 'Error',
          text: 'No se pudo agendar la cita',
          icon: 'error',
          confirmButtonText: 'Cerrar'
        })
        console.error(result);
      }
    })
    .catch(error => {
         Swal.fire({
          title: 'Error',
          text: 'Hubo un error con tu solicitud',
          icon: 'error',
          confirmButtonText: 'Cool'
        })
    });
    ciInput.value = '';
nameInput.value = '';
surnameInput.value = '';
emailInput.value = '';
phoneInput.value = '';
birthdateInput.value = '';
appointmentInput.value = '';
});