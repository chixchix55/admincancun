// document.addEventListener('DOMContentLoaded', () => {

let guardarCambiosBtn = document.getElementById('guardar-cambios');

if (guardarCambiosBtn != null){

  guardarCambiosBtn.addEventListener('click', () => {
    // Create the alert element
    const alertEl = document.createElement('div');
    alertEl.className = 'alert alert-success alert-dismissible position-fixed top-0 end-0 mt-3 me-3';
    alertEl.setAttribute('style', 'z-index: 9999;');
    alertEl.setAttribute('role', 'alert');
    alertEl.textContent = 'Los cambios se han guardado exitosamente';
    // Add the close button
    const closeButton = document.createElement('button');
    closeButton.className = 'btn-close';
    closeButton.setAttribute('type', 'button');
    closeButton.setAttribute('data-bs-dismiss', 'alert');
    closeButton.setAttribute('aria-label', 'Close');
    alertEl.appendChild(closeButton);
    setTimeout(() => {
      alertEl.remove();
    }, 2000);
    // Add the alert to the body
    document.body.appendChild(alertEl);
  });
}


// todo esto era para que se visualizaran las reservas en la tabla
// vendra desde el php
const reservas = [
  [1, "Juan Pérez", "Ciudad de México", "Cancún", "Todo incluido", "Paquete 1", "04/01/2023", "04/05/2023", 8000, "",""],
  [2, "María Gutiérrez", "Puerto Vallarta", "Los Cabos", "Sólo vuelo", "Paquete 2", "04/02/2023", "04/04/2023", 5000, "",""],
  [3, "Luis Hernández", "Mazatlán", "Cancún", "Sólo vuelo", "Paquete 3", "04/05/2023", "04/08/2023", 6000, "",""],
  [4, "Ana Torres", "Cancún", "Ciudad de México", "Todo incluido", "Paquete 4", "04/07/2023", "04/12/2023", 10000, "",""],
  [5, "Pedro García", "Los Cabos", "Puerto Vallarta", "Sólo vuelo", "Paquete 5", "04/10/2023", "04/14/2023", 4500, "",""],
  [6, "Mónica Sánchez", "Ciudad de México", "Acapulco", "Todo incluido", "Paquete 6", "04/11/2023", "04/15/2023", 7000, "",""],
  [7, "Jorge Rodríguez", "Cancún", "Mazatlán", "Sólo vuelo", "Paquete 7", "04/15/2023", "04/20/2023", 5500, "",""],
  [8, "Laura Torres", "Puerto Vallarta", "Los Cabos", "Todo incluido", "Paquete 8", "04/17/2023", "04/21/2023", 9000, "",""],
  [9, "Fernando Ruiz", "Mazatlán", "Ciudad de México", "Sólo vuelo", "Paquete 9", "04/20/2023", "04/24/2023", 4800, "",""],
  [10, "Sofía García", "Acapulco", "Puerto Vallarta", "Todo incluido", "Paquete 10", "04/23/2023", "04/28/2023", 7500, "",""]
];




const reservasBody = document.getElementById('tabla-contenido');

if (reservasBody != null) {
  reservas.forEach((reserva) => {
    const tr = document.createElement('tr');
    reserva.forEach((dato, index) => {
      const td = document.createElement('td');
      td.textContent = dato;
      tr.appendChild(td);
      if (index == 9){
        const span = document.createElement('span');
        span.className = 'badge bg-label-primary me-1';
        span.textContent = 'Activa';
        td.appendChild(span);
        // tr.appendChild(td);
      }
      if (index == 9){
        const td = document.createElement('td');
        // add the edit and delete buttons
        const editButton = document.createElement('button');
        editButton.className = 'btn btn-primary btn-sm me-2';
        editButton.setAttribute('data-bs-toggle', 'modal');
        editButton.setAttribute('data-bs-target', '#largeModal');
        editButton.textContent = 'Editar';
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.textContent = 'Eliminar';
        deleteButton.setAttribute('data-bs-toggle', 'modal');
        deleteButton.setAttribute('data-bs-target', '#modalCenter');
        td.appendChild(editButton);
        td.appendChild(deleteButton);
        tr.appendChild(td);
      }


    });
    reservasBody.appendChild(tr);
  });
}
// hasta aqui
// });
