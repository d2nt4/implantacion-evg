<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Añadir Alumno</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Gestión EVG - Añadir Alumno</h3>
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
				<?php include('application/views/Plantilla/asideGestor.php')?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verAlumnos'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<br class="gestion-apps">
						<?php
							$nia = array
							(
									'id'=>'nia',
									'name'=>'nia',
									'oninput'=>"buscarCSU('".base_url()."', 'Alumnos', this.value, 'nia', 'infoAjax', 'nia', 'Ya existe un alumno con el nia ')",
									'placeholder'=>'NIA',
									'required'=>'required',
									'class'=>'form-control'
							);

							$nombre = array
							(
									'name'=>'nombre',
									'placeholder'=>'Nombre',
									'required'=>'required',
									'class'=>'form-control'
							);


							$secciones = array
							(
									'name'=>'secciones',
									'options'=> $this->secciones,
									'class'=>'form-control'
							);

							$correo = array
							(
									'name'=>'correo',
									'size'=>'25',
									'maxsize'=>'25',
									'placeholder'=>'Correo',
									'class'=>'form-control'
							);

							$m = array
							(
									'name'  => 'sexo',
									'value' => 'm'
							);

							$f = array
							(
									'name'  => 'sexo',
									'value' => 'f'
							);

							$telefono = array
							(
									'name'=>'telefono',
									'size'=>'25',
									'maxsize'=>'25',
									'placeholder'=>'Teléfono',
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

							if(empty($this->secciones))
								echo 'Tiene que haber secciones creadas para añadir alumnos';
							else
							{
						?>
							<?php echo validation_errors() ;?>
							<?php echo form_open(base_url().'C_GestionEVG/anadirAlumno') ;?>
							<?php echo form_input($nia); ?>
							<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
							<?php echo form_input($nombre); ?></br>
							<?php echo form_label('Sección') ;?></br>
							<?php echo form_dropdown($secciones); ?></br>
							<?php echo form_input($correo); ?></br>
							<?php echo form_label('Género') ;?></br>
							<?php echo form_label('Masculino') ;?>
							<?php echo form_radio($m); ?>
							<?php echo form_label('Femenino') ;?>
							<?php echo form_radio($f); ?></br></br>
							<?php echo form_input($telefono); ?></br>
							<?php echo form_submit($enviar); ?>
							<?php echo form_close() ;?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
