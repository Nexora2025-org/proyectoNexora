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
              
              console.log(clave);
              if (!fechasOcupadas.includes(clave)) {
                const horaVisible = horaSQL.slice(0,5); 
                const label = `${fechaSQL} - ${horaVisible}`;
                const option = document.createElement("option");
                option.value = clave;
                option.textContent = label;
                appointmentSelect.appendChild(option);
              }else{
                console.log("cita ocupada");
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
  console.log(selectedValue);
  if(selectedValue.includes("OCUPADA")){
    alert("Cita ocupada");
  }
});