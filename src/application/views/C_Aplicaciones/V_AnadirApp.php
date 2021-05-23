<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Añadir Aplicación</title>
		<script>
			// Tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página.
			function pruebaInicial()
			{
				buscarCSU('<?php echo base_url() ;?>', 'Aplicaciones', '', 'nombre', 'infoAjax', 'nombre');
				buscarCSU('<?php echo base_url() ;?>', 'Aplicaciones', '', 'url', 'infoAjax2', 'url');
			}
		</script>
	</head>
	<body onload="pruebaInicial()">
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Administración EVG - Añadir Aplicación</h3>
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
				<?php include('application/views/Plantilla/asideAdmin.php') ?>
				<div class="general">

					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verApps'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$nombre = array
							(
									'id'=>'nombre',
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'nombre', 'infoAjax', 'nombre', 'Ya existe una aplicación con el nombre ')",
									'placeholder'=>'Nombre',
									'required'=>'required',
									'class'=>'form-control'
							);

							$descripcion = array
							(
									'name'=>'descripcion',
									'placeholder'=>'Descripción',
									'required'=>'required',
									'class'=>'form-control'
							);

							$url = array
							(
									'id'=>'url',
									'name'=>'url',
									'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'url', 'infoAjax2', 'url', 'Ya existe una aplicación con la URL ')",
									'placeholder'=>'URL de acceso',
									'required'=>'required',
									'class'=>'form-control'
							);

							$icono = array
							(
									'name'=>'icono',
									'onchange'=>'previsualizarImagen(this)',
									'required'=>'required',
									'class'=>'form-control'
							);

							$enviar = array
							(
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'disabled'=>'disabled',
									'class'=>'form-control'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open_multipart(base_url().'C_GestionEVG/anadirAPP'); ?>
						<?php echo form_input($nombre); ?>
						<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_input($descripcion); ?></br>
						<?php echo form_input($url); ?>
						<?php echo '<small id="infoAjax2" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Icono') ;?></br>
						<?php echo form_upload($icono); ?></br>
						<div class="icono-app"><img src="#" id="test" class="img-fluid" alt="Elegir Imagen"></div>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
