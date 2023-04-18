<?php
// Verificar si se han enviado datos por POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Recuperar los valores del formulario
	$usuario = $_POST["usuario"];
	$contrasena = $_POST["contraseña"];
	
	// Verificar que el usuario y la contraseña no estén vacíos
	if(empty($usuario) || empty($contrasena)) {
		echo "Ingrese su usuario y contraseña.";
		exit();
	}
		
	// Verificar las credenciales del usuario
	$limite_intentos = 5; // Establecer el límite de intentos de inicio de sesión
	$tiempo_bloqueo = 10; // Establecer el tiempo de bloqueo después de superar el límite de intentos
	
	// Conectar a la base de datos
	$host = "localhost";
	$db_usuario = "root";
	$db_contrasena = "";
	$db_nombre = "shuttlet_cancuncabtransportation";
	
	$conn = mysqli_connect($host, $db_usuario, $db_contrasena, $db_nombre);
	
	if(!$conn) {
		die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM usuario WHERE usser = '$usuario'";
	$resultado = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($resultado);

	if(verificar_credenciales($usuario, $contrasena, $row)) {
		// Si las credenciales son correctas, redirigir al usuario a la página principal
		session_start();
		mysqli_close($conn);
		$_SESSION["usuario"] = $usuario;
		header("Location: admin/admin.html");
		exit();
	} else {
		// Si las credenciales son incorrectas, aumentar el contador de intentos de inicio de sesión
		session_start();
		if(!isset($_SESSION["intentos"])) {
			$_SESSION["intentos"] = 1;
		} else {
			$_SESSION["intentos"]++;
		}
		// Si se han superado el límite de intentos de inicio de sesión, bloquear al usuario temporalmente
		if($_SESSION["intentos"] >= $limite_intentos) {
			sleep($tiempo_bloqueo);
		}
		echo "Usuario o contraseña incorrectos.";
		
	}
}

function verificar_credenciales($usuario, $contrasena, $row) {
	// Aquí debería ir la lógica para verificar las credenciales en una base de datos o algún otro sistema de autenticación
	$salt =  $row['key_user'];
	// Encriptar la contraseña
	$contrasena_encriptada = hash('sha256', $salt . $contrasena);
	$contrasena_bd = $row['contrasena'];

	if($contrasena_bd == $contrasena_encriptada) {
			// Inicio de sesión exitoso
			return true;
	}else
			return false;		

}
?>