<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Añadir Curso</title>
		<script>
			// Tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página.
			function pruebaInicial()
			{
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'codCurso', 'infoAjax', 'codCurso');
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'idCursoColegio', 'infoAjax2', 'idCursoColegio');
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'nombre', 'infoAjax3', 'nombre');
			}
		</script>
	</head>
	<body onload="pruebaInicial()">
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Gestión EVG - Añadir Curso</h3>
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "main'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Aplicaciones\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include_once('application/views/Plantilla/asideGestor.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars" data-toggle="popover" data-content="Mostrar menú"></i>
						<i class="fas fa-times" data-toggle="popover" data-content="Ocultar menú"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "courses'\" class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Volver atrás\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$codCurso = array
							(
									'id'=>'codCurso',
									'name'=>'codCurso',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'codCurso', 'infoAjax', 'codCurso', 'Ya existe un curso con el código ')",
									'placeholder'=>'Código',
									'required'=>'required',
									'class'=>'form-control'
							);
	
							$idCursoColegio = array
							(
									'id'=>'idCursoColegio',
									'name'=>'idCursoColegio',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'idCursoColegio', 'infoAjax2', 'idCursoColegio', 'Ya existe un curso con el id ')",
									'placeholder'=>'Identificador de curso del colegio',
									'class'=>'form-control'
							);
	
							$nombre = array
							(
									'id'=>'nombre',
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'nombre', 'infoAjax3', 'nombre', 'Ya existe un curso con el nombre ')",
									'placeholder'=>'Nombre',
									'required'=>'required',
									'class'=>'form-control'
							);

							$enviar = array
							(
									'type'=>'submit',
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'disabled'=>'disabled',
									'class'=>'form-control'
							);
						?>
						
						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/anadirCurso'); ?>
						<?php echo form_input($codCurso); ?>
						<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_input($idCursoColegio); ?>
						<?php echo '<small id="infoAjax2" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<small id="infoAjax3" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
