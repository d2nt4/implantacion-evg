<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Añadir Curso</title>
		<script>
			// Tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página
			function pruebaInicial()
			{
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'codCurso', 'infoAjax', ' ');
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'idCursoColegio', 'infoAjax2', ' ');
				buscarCSU('<?php echo base_url() ;?>', 'Cursos', '', 'nombre', 'infoAjax3', ' ');
			}// hago esto para que se inicialice el array que contiene la información de los id que deben ser correctos, si no, puede dar fallos
		</script>
	</head>
	<body onload="pruebaInicial()">
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Cursos - Añadir Curso</h3>
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
				<?php include('application/views/Plantilla/asideGestor.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/VerCursos'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$codCurso = array
							(
									'name'=>'codCurso',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'codCurso', 'infoAjax', 'Ya existe un curso con el código ')",
									'placeholder'=>'Código',
									'required'=>'required'
							);
	
							$idCursoColegio = array
							(
									'name'=>'idCursoColegio',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'idCursoColegio', 'infoAjax2', 'Ya existe un curso con el id ')",
									'placeholder'=>'Identificador de curso del colegio'
							);
	
							$nombre = array
							(
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'nombre', 'infoAjax3', 'Ya existe un curso con el nombre ')",
									'placeholder'=>'Nombre',
									'required'=>'required'
							);
						?>
						
						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/anadirCurso'); ?>
						<?php echo form_input($codCurso); ?>
						<?php echo '<div id="infoAjax" class="divInfo"></div>'; ?></br>
						<?php echo form_input($idCursoColegio); ?>
						<?php echo '<div id="infoAjax2" class="divInfo"></div>'; ?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<div id="infoAjax3" class="divInfo"></div>'; ?></br>
						<?php echo '<div class="submit-container">'.form_submit('enviar','ENVIAR', 'disabled').'</div>'; ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
