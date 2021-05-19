<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Modificar Aplicación</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<?php echo '<h3>Modificar Aplicación - '.$this->datosApp[0]['nombre'].'</h3>'; ?>
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
			<div class="row" id="contenedor">
				<?php include('application/views/Plantilla/asideAdmin.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/VerApps'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestiones">
						<div class="gestion-apps">
							<?php
								$nombre = array
								(
										'name'=>'nombre',
										'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'nombre', 'infoAjax', 'Ya existe otra aplicación con el nombre ', '".$this->datosApp[0]['nombre']."')",
										'value'=>$this->datosApp[0]['nombre'],
										'required'=>'required'
								);

								$descripcion = array
								(
										'name'=>'descripcion',
										'value'=>$this->datosApp[0]['descripcion'],
										'required'=>'required'
								);

								$url = array
								(
										'name'=>'url',
										'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'url', 'infoAjax2', 'Ya existe otra aplicación con la url ', '".$this->datosApp[0]['url']."')",
										'value'=>$this->datosApp[0]['url'],
										'required'=>'required'
								);

								$icono = array
								(
										'name'=>'icono',
										'onchange'=>'previsualizarImagen(this)'
								);
							?>

							<?php echo validation_errors(); ?>
							<?php echo form_open_multipart(base_url().'C_GestionEVG/modificarApp/'.$idAplicacion); ?>
							<?php echo form_label('Nombre'); ?></br>
							<?php echo form_input($nombre); ?></br>
							<?php echo '<div class="divInfo" id="infoAjax" style="display: none"></div>'; ?>
							<?php echo form_label('Descripción'); ?></br>
							<?php echo form_input($descripcion); ?></br>
							<?php echo form_label('URL de acceso'); ?></br>
							<?php echo form_input($url); ?>
							<?php echo '<div class="divInfo" id="infoAjax2" style="display: none;"></div>'; ?></br>
							<?php echo form_label('Icono'); ?></br>
							<?php echo form_upload($icono); ?></br>
							<?php if(!empty($this->datosApp[0]['icono'])) echo '<div class="icono-app"><img src="'.base_url().'uploads/iconos/'.$this->datosApp[0]['icono'].'" id="test" class="img-fluid"/></div>' ?>
							<?php echo '<div class="submit-container">'.form_submit('enviar','ENVIAR').'</div>'; ?>
							<?php echo form_close() ;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
