<?php include 'templates/header.php' ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
       <?php   
              $host = "localhost";
              $db_usuario = "root";
              $db_contrasena = "";
              $db_nombre = "shuttlet_cancuncabtransportation";

              $conn = mysqli_connect($host, $db_usuario, $db_contrasena, $db_nombre);

              if(!$conn) {
                die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
              }
              $consulta = "SELECT r.id_reserva, c.nombre_cliente, l1.nombre as n1, l2.nombre as n2, t.nombre_tipo, p.nombre_paquete, r.fecha_ida, r.fecha_regreso, r.estatus, r.precio
              FROM reserva AS r
              JOIN cliente AS c ON r.Id_cliente = c.Id_cliente
              JOIN lugar AS l1 ON r.Id_lugar_uno = l1.Id_lugar
              JOIN lugar AS l2 ON r.Id_lugar_dos = l2.Id_lugar
              JOIN tipo AS t ON r.Id_tipo_viaje = t.Id_tipo
              JOIN paquete AS p ON r.Id_paquete = p.Id_paquete
              WHERE r.fecha_ida >= CURRENT_DATE;";
              $resultado = mysqli_query($conn,$consulta);
  
        ?>
            <!-- Modals -->
            <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Modificar Reserva</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="numReserva" class="form-label">Numero Reserva</label>
                          <input type="text" id="numReserva" class="form-control" readonly placeholder="1" />
                        </div>
                        <div class="col mb-3">
                          <label for="cliente" class="form-label">Cliente</label>
                          <input type="text" id="cliente" class="form-control" readonly placeholder="John Doe" />
                        </div>
                    </div>
                      <div class="row g-2">
                        <div class="col mb-0">
                          <label for="salida" class="form-label">Salida</label>
                          <select id="salida" class="form-select">
                            <option selected>San Salvador</option>
                            <!-- Add other options as needed -->
                          </select>
                        </div>
                        <div class="col mb-0">
                          <label for="destino" class="form-label">Destino</label>
                          <select id="destino" class="form-select">
                            <option selected>Guatemala</option>
                            <!-- Add other options as needed -->
                          </select>
                        </div>
                      </div>
                      <div class="row g-2">
                        <div class="col mb-0">
                          <label for="tipo" class="form-label">Tipo de Viaje</label>
                          <select id="tipo" class="form-select">
                            <option selected>Ida y Vuelta</option>
                            <!-- Add other options as needed -->
                          </select>
                        </div>
                        <div class="col mb-0">
                          <label for="paquete" class="form-label">Paquete</label>
                          <select id="paquete" class="form-select">
                            <option selected>Paquete 1</option>
                            <!-- Add other options as needed -->
                          </select>
                        </div>
                      </div>
                      <div class="row g-2">
                        <div class="col mb-0">
                          <label for="fechaIda" class="form-label">Fecha Ida</label>
                          <input type="date" id="fechaIda" class="form-control" placeholder="2021-05-05" />
                        </div>
                        <div class="col mb-0">
                          <label for="fechaRegreso" class="form-label">Fecha Regreso</label>
                          <input type="date" id="fechaRegreso" class="form-control" placeholder="2021-05-05" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-0">
                          <label for="precio" class="form-label">Precio</label>
                          <input type="text" id="precio" class="form-control" readonly placeholder="$100" />
                        </div>
                        <div class="col mb-0">
                          <label for="estado" class="form-label">Estado</label>
                          <select id="estado" class="form-select">
                            <option selected>Placeholder</option>
                            <!-- Add other options as needed -->
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Cancelar
                    </button>
                    <button id="guardar-cambios" type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Estas seguro?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>Esta seguro que desea eliminar este registro?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Cancelar
                    </button>
                    <button type="button" class="btn btn-danger btn-m" data-bs-dismiss="modal">Eliminar</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Content -->
            <div class="card m-5">
              <h5 class="card-header">Reservas</h5>
              <div class="table-responsive text-nowrap">
                <table id="tabla-reservas" class="table">
                  <thead>
                    
                    <tr>
                    <th>Nº Reserva</th>
                      <th>Cliente</th>
                      <th>Salida</th>
                      <th>Destino</th>
                      <th>Tipo</th>
                      <th>Paquete</th>
                      <th>Fecha ida</th>
                      <th>Fecha regreso</th>
                      <th>Precio</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    
                  </thead>
                  <tbody id='tabla-contenido' class="table-border-bottom-0">
                  <?php while ($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                    <td><?= $row['id_reserva']?></td>
                      <td><?= $row['nombre_cliente'] ?></td>
                      <td><?= $row['n1'] ?></td>
                      <td><?= $row['n2'] ?></td>
                      <td><?= $row['nombre_tipo'] ?></td>
                      <td><?= $row['nombre_paquete'] ?></td>
                      <td><?= $row['fecha_ida'] ?></td>
                      <td><?= $row['fecha_regreso'] ?></td>
                      <td><?= $row['precio'] ?></td>
                      <?php
                          $estatus = $row['estatus'];
                          $label_class = '';
                          $label_text = '';

                          if ($estatus == 1) {
                              $label_class = 'bg-label-primary';
                              $label_text = 'Activa';
                          } elseif ($estatus == 2) {
                              $label_class = 'bg-label-warning';
                              $label_text = 'Pendiente';
                          } elseif ($estatus == 3) {
                              $label_class = 'bg-label-success';
                              $label_text = 'Completada';
                          } elseif ($estatus == 4) {
                              $label_class = 'bg-label-info';
                              $label_text = 'Cancelada';
                          }
                      ?>

                      <td><span class="badge <?php echo $label_class; ?> me-1"><?php echo $label_text; ?></span></td>
                      <?php 
                          $data = array(
                            "id" => $row['id_reserva'],
                            "nombre" => $row['nombre_cliente'],
                            "n1" => $row['n1'],
                            "n2" => $row['n2'],
                            "nombretipo" => $row['nombre_tipo'],
                            "nombrepaquete" => $row['nombre_paquete'],
                            "fechaida" => $row['fecha_ida'],
                            "fecharegreso" => $row['fecha_regreso'],
                            "precio" => $row['precio'],
                          );
                        
                          // Encode the array as JSON
                          $jsonString = json_encode($data);                          
                      ?>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm edit" data-bs-toggle="modal" data-bs-target="#largeModal" data= '<?php echo $jsonString;?>'>Editar</button>
                        <button type="button"  class="btn btn-danger btn-sm eliminar-reserva" data-bs-toggle="modal" data-bs-target="#modalCenter" >Eliminar</button>
                        <form method="POST" >
                          <input style="display: none" name="txtID" id="txtID" value="<?php echo $row['id_reserva']; ?>" />

                        </form>

                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
<?php include 'templates/footer.php' ?>