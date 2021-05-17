<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Importar Usuarios</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="' . base_url() . 'C_GestionEVG/"><img id="logo-evg" src="' . base_url() . 'uploads/iconos/escudo-evg.png" alt="img-fluid" class="img-fluid"/></a>'; ?>
						<h3>GestiónEVG - Importar Usuarios</h3>
					</div>
					<div class="col-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/'\" id=\"icon-grid\" class=\"btn mr-2\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this->session->userdata('profile_pic');
							echo '<img id="profile_picture" src="' . $picture . '" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','" . base_url() . "Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>"; ?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include('application/views/Plantilla/asideGestor.php') ?>
				<content>
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verUsuarios'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$usuarios = array
							(
									'name'=>'archivo',
									'required'=>'required'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open_multipart(base_url().'C_GestionEVG/importarUsuarios'); ?>
						<?php echo form_upload($usuarios); ?><br/>
						<?php echo form_submit('enviar','ENVIAR'); ?><br/>
						<?php echo form_close(); ?>
					</div>
				</content>
			</div>
		</div>
	</body>
</html>
