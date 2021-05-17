<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Modificar Usuario</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="' . base_url() . 'C_GestionEVG/"><img id="logo-evg" src="' . base_url() . 'uploads/iconos/escudo-evg.png" alt="img-fluid" class="img-fluid"/></a>'; ?>
						<h3>GestiónEVG - Modificar Usuario</h3>
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
							$nombre = array
							(
									'name'=>'nombre',
									'value'=>$this->datosUsuario[0]['nombre'],
									'required'=>'required'
							);

							$correo = array
							(
									'name'=>'correo',
									'oninput'=>"buscarCSU('".base_url()."', 'Usuarios', this.value, 'correo', 'infoAjax', 'Ya existe otro usuario con el correo ', '".$this->datosUsuario[0]['correo']."')",
									'value'=>$this->datosUsuario[0]['correo'],
									'required'=>'required'
							);

							$bajaTemporal = array
							(
									'name'=>'bajaTemporal'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/modificarUsuario/'.$idUsuario); ?>
						<?php echo form_label('Nombre:'); ?><br/>
						<?php echo form_input($nombre); ?><br/>
						<?php echo form_label('Correo:'); ?><br/>
						<?php echo form_input($correo); ?>
						<?php echo '<div id="infoAjax" class="divInfo"></div>'; ?><br/>
						<?php echo form_checkbox('bajaTemporal','on',$this->datosUsuario[0]['bajaTemporal'],$bajaTemporal); ?>
						<?php echo form_label('Baja temporal'); ?><br/>
						<?php echo form_submit('enviar','ENVIAR'); ?><br/>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
