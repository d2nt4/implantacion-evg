<html>
<head>
	<title>Inicio de sesión</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!--App Favicon-->
	<link rel="shortcut icon" href="<?=base_url()?>favicon.ico" type="image/x-icon" />;

	<!-- Compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

	<?php include 'application/views/Plantilla/header.php'?>
</head>
<body>
	
	<div id="inicioSesionGoogleTitulo">
		<h2>Inicio de sesión</h2>
	</div>
	<div class="container" id="inicioSesionGoogle">
		<div class="row">
			<div class="col s12 m6 l6">

				<?php 
				if($this->session->userdata('sess_logged_in')==0){?>
					<a id="botonInicioCierre" href="<?=$google_login_url?>"class="waves-effect waves-light btn red"><i class="fa fa-google left"></i>Iniciar sesión con Google</a>
				<?php }else{?>
					<a id="botonInicioCierre" href="<?=base_url()?>auth/logout" class="waves-effect waves-light btn red"><i class="fa fa-google left"></i>Cerrar sesión</a>
					<p id="infoSesion">Parece que ha iniciado sesión con una cuenta no registrada en la aplicación, cambie la cuenta o pida al administrador que añada su correo a la aplicación</p>
				<?php }
				?>
	
			</div>
		</div>
		<div class="row" id="inicioSesionGoogleCarta">
			<?php if(isset($_SESSION['name'])){?>
				<div class="col s12 m6 l4 offset-l3 " >
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
</body>
</html>
