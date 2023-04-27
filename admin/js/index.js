const tipos = ["IDA", "IDA Y VUELTA", "MULTIDESTINO"]// change it for the real data
// document.addEventListener('DOMContentLoaded', () => {
  document.addEventListener("DOMContentLoaded", function() {
    let modalTrigger = document.getElementById('modificar-reserva');
    //#region Modificar Reservas
    
    //#region Campos modificar reserva
    const numReserva = document.querySelector('#numReserva');
    const nombre = document.querySelector('#cliente');
    const n1 = document.querySelector('#salida');
    const n2 = document.querySelector('#destino');
    const nombretipo = document.querySelector('#tipo');
    const nombrepaquete = document.querySelector('#paquete');
    const fechaida = document.querySelector('#fechaIda');
    const fecharegreso = document.querySelector('#fechaRegreso');
    const precio = document.querySelector('#precio');
    const estado = document.querySelector('#estado');
    // #endregion
    
    // Funcion para llenar los campos de reserva

    modalTrigger.addEventListener('click', function(event) {
      let button = event.target
      let data = button.getAttribute('data-whatever')
      let dataObject = JSON.parse(data)
      numReserva.value = dataObject.id
      nombre.value = dataObject.nombre
      n1.value = dataObject.n1
      n2.value = dataObject.n2
      nombretipo.value = dataObject.nombretipo
      nombrepaquete.value = dataObject.nombrepaquete
      fechaida.value = dataObject.fechaida
      fecharegreso.value = dataObject.fecharegreso
      precio.value = dataObject.precio
      // estado.value = dataObject.estado
      if (nombretipo.value === "IDA"){
        fecharegreso.disabled = true;
        fecharegreso.value = "";
      }
      nombretipo.addEventListener('change', function(){
        if (nombretipo.value === "IDA"){
          fecharegreso.disabled = true;
          fecharegreso.value = "";
        }
        else{
          fecharegreso.disabled = false;
        }
      });
      //#region Dropdown tipo
      const dropdown = document.getElementById("tipo-dropdown");
      nombretipo.addEventListener('input',()=> {
        // Clear the previous dropdown items
      dropdown.innerHTML = "";
      // if the value is empty, don't show the dropdown
      if (!nombretipo.value) {
        dropdown.style.display = "none";
        return;
      }       
      // Filter the items based on the input value
      const filteredTipos = tipos.filter(function(tipo) {
        return tipo.toLowerCase().includes(nombretipo.value.toLowerCase());
      });
      // Create a new dropdown item for each filtered item
      filteredTipos.forEach(function(tipo) {
        const option = document.createElement("div");
        option.textContent = tipo;
        option.addEventListener("click", function() {
          // Set the input value to the clicked item
          nombretipo.value = tipo;
          // Hide the dropdown
          dropdown.innerHTML = "";
          dropdown.style.display = "none";
        });
        option.addEventListener("mouseover", function() {
          // Change background color on hover
          option.style.backgroundColor = "#c5c5c5";
        });
        option.addEventListener("mouseout", function() {
          // Reset background color on mouse out
          option.style.backgroundColor = "#f1f1f1";
        });
        option.style.borderRadius = "0.25rem";
        option.style.padding = "0.25rem 0.5rem";
        dropdown.appendChild(option);
      });
      
      // Show the dropdown if there are filtered items, otherwise hide it
      if (filteredTipos.length > 0) {
        dropdown.style.display = "block";
        dropdown.style.position = "absolute";
        dropdown.style.zIndex = "1000";
        dropdown.style.padding = "0.5rem"
        dropdown.style.marginLeft = "0.2rem"
        dropdown.style.width = nombretipo.offsetWidth + "px";
        dropdown.style.top = (nombretipo.offsetTop + nombretipo.offsetHeight) + "px";
        dropdown.style.backgroundColor = "#f1f1f1";
        dropdown.style.left = nombretipo.offsetLeft-3 + "px";
        dropdown.style.cursor = "pointer";
        dropdown.style.borderRadius = "0.25rem";
      } else {
        dropdown.style.display = "none";
      }
    });

    nombretipo.addEventListener('blur', () => {
      // Validate that the input value is in the tipos array
      const filteredTipos = tipos.filter(function(tipo) {
        return tipo.toLowerCase().includes(nombretipo.value.toLowerCase());
      });
      if (nombretipo.value === "" || filteredTipos.length === 0) {
        event.preventDefault();
        const alertEl = document.createElement('div');
        alertEl.className = `alert alert-danger position-fixed top-0 end-0 mt-3 me-3`;
        alertEl.setAttribute('style', 'z-index: 9999;');
        alertEl.setAttribute('role', 'alert');
        alertEl.textContent = 'El tipo de reserva no es válido';
        // Add the close button
        const closeButton = document.createElement('button');
        closeButton.className = 'btn-close';
        closeButton.setAttribute('type', 'button');
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Close');
        alertEl.appendChild(closeButton);
        setTimeout(() => {
          alertEl.remove();
        }, 5000);
        // Add the alert to the body
        document.body.appendChild(alertEl);
      }

    });

    //#endregion

    });

    
    // #endregion
  });


let guardarCambiosBtn = document.getElementById('guardar-cambios');

if (guardarCambiosBtn != null){

  guardarCambiosBtn.addEventListener('click', (event) => {
    // Create the alert element
    const validateDates = (prevDate, nextDate) => {
      const prev = new Date(prevDate);
      const next = new Date(nextDate);
      if (prev > next) {
        return false;
      }
      return true;
    }
    const fechaida = document.getElementById('fechaIda');
    const fecharegreso = document.getElementById('fechaRegreso');
    const nombretipo = document.getElementById('tipo');
    let type_of_alert = '';
    let text_content = '';

    // Filter the items based on the input value
    const filteredTipos = tipos.filter(function(tipo) {
      return tipo.toLowerCase().includes(nombretipo.value.toLowerCase());
    });

    if (!validateDates(fechaida.value, fecharegreso.value)) {
      event.preventDefault();
      type_of_alert = 'alert alert-danger alert-dismissible';
      text_content = 'La fecha de regreso no puede ser menor a la fecha de ida'
    }
    else if (nombretipo.value === "" || filteredTipos.length === 0) {
      event.preventDefault();
      type_of_alert = 'alert alert-danger alert-dismissible';
      text_content = 'El tipo de reserva no es válido';
    }
    else{
      type_of_alert = 'alert alert-success alert-dismissible';
      text_content = 'Los cambios se han guardado exitosamente';
      const myModal = document.getElementById('largeModal');
      const modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
    }

    const alertEl = document.createElement('div');
    alertEl.className = `${type_of_alert} position-fixed top-0 end-0 mt-3 me-3`;
    alertEl.setAttribute('style', 'z-index: 9999;');
    alertEl.setAttribute('role', 'alert');
    alertEl.textContent = text_content;
    // Add the close button
    const closeButton = document.createElement('button');
    closeButton.className = 'btn-close';
    closeButton.setAttribute('type', 'button');
    closeButton.setAttribute('data-bs-dismiss', 'alert');
    closeButton.setAttribute('aria-label', 'Close');
    alertEl.appendChild(closeButton);
    setTimeout(() => {
      alertEl.remove();
    }, 5000);
    // Add the alert to the body
    document.body.appendChild(alertEl);
  });
}


