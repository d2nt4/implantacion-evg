<html>
<head>
	<title>GestiónEVG - Inicio de sesión</title>

	<?php include 'application/views/Plantilla/header.php'?>

	<style>
		body
		{
			height: 100%;
			width: 100%;
			display: table;
		}

		#logo
		{
			width: 6rem;
			height: 100%;
		}
	</style>
</head>
<body>
<div id="main" class="container">
		<div class="d-table mx-auto mb-2">
			<div id="logo" class="d-table-cell align-middle"><img src="<?=base_url()?>uploads/iconos/evg.png" class="img-fluid" alt="EVG Logo"></div>
			<div class="p-2 d-table-cell align-middle"><h2 class="font-weight-bolder">Gestión EVG</h2></div>
		</div>
		<div id="inicioSesionGoogle">
		<div>
				<?php 
				if($this->session->userdata('sess_logged_in')==0){?>
					<a href="<?=$google_login_url?>" class="btn btn-danger gbtn font-weight-bolder"><i class="fa fa-google left mr-2"></i>Iniciar sesión con Google</a>
				<?php }else{?>
					
				<?php }
				?>
			</div>
			<div id="cartaGoogle">
				<?php if(isset($_SESSION['name'])){?>
					<div class="card">
						<img src="<?=$_SESSION['profile_pic']?>" class="card-img-top" alt="Google Account Profile Picture"/>
						<div class="card-body">
							<h3 class="card-title"><?=$_SESSION['name']?></h3>
							<p class="card-subtitle my-3"><?=$_SESSION['email']?></p>
							<p class="card-text">Parece que ha iniciado sesión con una cuenta no registrada en la aplicación, cambie la cuenta o pida al administrador que añada su correo a la aplicación.</p>
							<a href="<?=base_url()?>auth/logout" class="btn btn-danger gbtn font-weight-bolder"><i class="fa fa-google left mr-2"></i>Cerrar sesión</a>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</body>
</html>
