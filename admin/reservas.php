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

if ($resultado) {
		while ($row = $resultado->fetch_assoc()) {
		$id_reserva = $row['id_reserva'];
		$nombre_cliente = $row['nombre_cliente'];
		$nombre1 = $row['n1'];
		$nombre2 = $row['n2'];
		$nombre_tipo = $row['nombre_tipo'];
		$nombre_paquete = $row['nombre_paquete'];
		$fecha_ida = $row['fecha_ida'];
		$fecha_regreso = $row['fecha_regreso'];
		$estatus = $row['estatus'];
		$precio = $row['precio'];
	    ?>
                    <tr>
                      <td><?= $id_reserva ?></td>
                      <td><?= $nombre_cliente ?></td>
                      <td><?= $nombre1 ?></td>
                      <td><?= $nombre2 ?></td>
                      <td><?= $nombre_tipo ?></td>
                      <td><?= $nombre_paquete ?></td>
                      <td><?= $fecha_ida ?></td>
                      <td><?= $fecha_regreso ?></td>
					  <?php 
					    if ($estatus = 1){
							?><td><span class="badge bg-label-primary me-1">Activa</span></td><?php 
						}
						else
						?><td><span class="badge bg-label-primary me-1">Cancelada</span></td>
					  <td><?= $estatus ?></td>
					  <td><?= $precio ?></td>
                      <td>
                        <a href="#" class="btn btn-primary btn-sm">Editar</a>
                        <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                      </td>
                    </tr>
	    <?php
	    }
	}
?>