const guardarCambiosBtn = document.getElementById('guardar-cambios');
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

const body = document.getElementById('tabla-contenido');

// const tbody = document.getElementById('tabla-contenido');
