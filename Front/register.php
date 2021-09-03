<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$nombre = mysqli_real_escape_string($con, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($con, $_POST['apellido']);
	$mail = mysqli_real_escape_string($con, $_POST['mail']);
	$dni = mysqli_real_escape_string($con, $_POST['dni']);
	$edad = mysqli_real_escape_string($con, $_POST['edad']);
	$nombreusuario = mysqli_real_escape_string($con, $_POST['nombreusuario']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	$terminosycond = mysqli_real_escape_string($con, $_POST['terminosycond']);
	$telefono = mysqli_real_escape_string($con, $_POST['telefono']);

	
	//Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
	if (!preg_match("/^[a-zA-Z ]+$/",$nombre)) {
		$error = true;
		$name_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$apellido)) {
		$error = true;
		$last_name_error = "El apellido debe contener solo caracteres del alfabeto y espacio.";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$nombreusuario)) {
		$error = true;
		$user_name_error = "El nombre de usuario debe contener solo caracteres del alfabeto y espacio.";
	}
	if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Ingresa un correo electrónico válido.";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "La contraseña debe tener un mínimo de 6 caracteres.";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Las contraseñas no coinciden";
	}

	if(!$terminosycond) {
		//$error = true;
		//$terminosycond_error = "Debes aceptar Terminos y condiciones";
	}
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO usuarios (Nombre,Apellido,DNI,Edad,Mail,NombreUsuario,Telefono,Contraseña) VALUES('" . $nombre . "','" . $apellido . "','" . $dni . "','" . $edad . "', '" . $mail . "','" . $nombreusuario . "','" . $telefono . "', '" . md5($password) . "')")) {
			//$successmsg = "¡Registrado exitosamente! <a href='login.php'>Click here to Login</a>";
			$successmsg = '
			  <div class="alert alert-success alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>EXITO.!</strong> ¡Registrado exitosamente!
			  </div>
			  ';
		} else {
			//$errormsg = "Error de registro. Vuelve a intentarlo más tarde.";
			$errormsg = '
			<div class="alert alert-danger alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Error de registro.!</strong> Verifica tus datos.
			</div>
			';
		}
	}
}
?>

<?php 
	require "head.php";
 ?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Registro</legend>

					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" name="nombre" placeholder="Nombres" required value="<?php if($error) echo $nombre; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Apellido</label>
						<input type="text" name="apellido" placeholder="Apellidos" required value="<?php if($error) echo $apellido; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($last_name_error)) echo $last_name_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Nombre usuario</label>
						<input type="text" name="nombreusuario" placeholder="Nombre Usuario" required value="<?php if($error) echo $nombreusuario; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($user_name_error)) echo $user_name_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="email" name="mail" placeholder="Correo Electrónico" required value="<?php if($error) echo $mail; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Edad</label>
						<input type="text" name="edad" placeholder="Nombre usuario" required value="<?php if($error) echo $edad; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($age_error)) echo $age_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">DNI</label>
						<input type="text" name="dni" placeholder="DNI" required value="<?php if($error) echo $dni; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($dni_error)) echo $dni_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Telefono</label>
						<input type="text" name="telefono" placeholder="telefono" required value="<?php if($error) echo $telefono; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($dni_error)) echo $dni_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="password" placeholder="Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Repita Contraseña</label>
						<input type="password" name="cpassword" placeholder="Confirmar Contraseña" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div> 

					
					<div class="checkbox">
					    <label>
					      <input type="checkbox" name="terminosycond" id="terminosycond" required=""> Acepto todos los 
					      <!-- Button trigger modal -->
							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#TernimosCondiciones">
							  Terminos y condiciones
							</button>
							<br>
							<span class="text-danger"><?php if (isset($terminosycond_error)) echo $terminosycond_error; ?></span>
					    </label>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Registrar" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Ya te registaste? <a href="login.php">Logeate Aqui</a>
		</div>
	</div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<!-- Modal -->
<div class="modal fade" id="TernimosCondiciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
        	<b>Terminos y Condiciones </b>
        </h4>
      </div>
      <div class="modal-body">
        Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! 
        <br>
        <br>
        <p>
        	<b>Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! </b>
        </p>
		<p>
			<ul>
				<li>Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! </li>
				<li>Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! Terminos y condiciones! </li>
				<br>
				<a href="#" class="btn btn-default btn-xs">
					<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Descargar PDF
				</a>
			</ul>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <!--button type="button" class="btn btn-primary">Guardar Cambios</button-->
      </div>
    </div>
  </div>
</div>

<script>
	//Modal terminos y condiciones
	$('#TernimosCondiciones').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
</script>