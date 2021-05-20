<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Modificar Perfil</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<?php echo "<h3>Modificar Perfil - ".$this->datosPerfil[0]['nombre']."</h3>"?>
					</div>
					<div class="col-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/'\" id=\"icon-grid\" class=\"btn mr-2\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include('application/views/Plantilla/asideAdmin.php')?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verPerfiles'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestiones">
						<div class="gestion-apps">
							<?php
								$nombre = array
								(
										'name'=>'nombre',
										'oninput'=>"buscarCSU('".base_url()."', 'Perfiles', this.value, 'nombre', 'infoAjax', 'Ya existe otro perfil con el nombre ', '".$this->datosPerfil[0]['nombre']."')",
										'value'=>$this->datosPerfil[0]['nombre'],
										'required'=>'required'
								);

								$descripcion = array
								(
										'name'=>'descripcion',
										'value'=>$this->datosPerfil[0]['descripcion'],
										'required'=>'required'
								);
							?>

							<?php echo validation_errors(); ?>
							<?php echo form_open(base_url().'C_GestionEVG/modificarPerfil/'.$idPerfil) ;?><!--Correcta, pero da fallo en PHPStorm-->
							<?php echo form_label('Nombre:'); ?></br>
							<?php echo form_input($nombre); ?>
							<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?></br>
							<?php echo form_label('Descripción:'); ?></br>
							<?php echo form_input($descripcion); ?></br>
							<?php echo '<div class="submit-container">'.form_submit('enviar','ENVIAR').'</div>'; ?></br>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
