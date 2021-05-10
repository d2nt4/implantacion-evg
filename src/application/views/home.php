<html>
<head>
	<title>Inicio de sesión</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
	<!--App Favicon-->
	<link rel="shortcut icon" href="<?=base_url()?>favicon.ico" type="image/x-icon" />;

	<!-- Compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

	<?php include 'application/views/Plantilla/header.php'?>

	<style>
		body
		{
			height: 100%;
			width: 100%;
			display: table;
		}
	</style>
</head>
<body>
<div id="main" class="container">
		<h2 class="font-weight-bolder">Inicio de sesión</h2>
		<div id="inicioSesionGoogle">
			<div>
				<?php 
				if($this->session->userdata('sess_logged_in')==0){?>
					<a id="botonInicioCierre" href="<?=$google_login_url?>"class="waves-effect waves-light btn red"><i class="fa fa-google left"></i>Iniciar sesión con Google</a>
				<?php }else{?>
					<a id="botonInicioCierre" href="<?=base_url()?>auth/logout" class="waves-effect waves-light btn red"><i class="fa fa-google left"></i>Cerrar sesión</a>
					<p id="infoSesion">Parece que ha iniciado sesión con una cuenta no registrada en la aplicación, cambie la cuenta o pida al administrador que añada su correo a la aplicación</p>
				<?php }
				?>
			</div>
			<div id="inicioSesionGoogleCarta">
				<?php if(isset($_SESSION['name'])){?>
					<div>
						<div class="card ">
							<div class="card-image waves-effect waves-block waves-light">
								<img class="activator" src="<?=$_SESSION['profile_pic']?>">
							</div>
							<div class="card-content">
								<span class="card-title activator grey-text text-darken-4"> <i class="material-icons"><?=$_SESSION['name']?></i></span>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?=$_SESSION['name']?><i id="cerrarCard" class="material-icons right">cerrar</i></span>
								<p><?=$_SESSION['email']?></p>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</body>
</html>
