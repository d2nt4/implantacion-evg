<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Añadir Alumno</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Gestión EVG - Añadir Alumno</h3>
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
				<?php include_once('application/views/Plantilla/asideGestor.php')?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars" data-toggle="popover" data-content="Mostrar menú"></i>
						<i class="fas fa-times" data-toggle="popover" data-content="Ocultar menú"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "students'\" class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Volver atrás\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$dni = array
							(
									'id'=>'dni',
									'name'=>'dni',
									'oninput'=>"buscarCSU('".base_url()."', 'Alumnos', this.value, 'dni', 'infoAjax', 'dni', 'Ya existe un alumno con el dni ')",
									'placeholder'=>'DNI',
									'required'=>'required',
									'class'=>'form-control'
							);

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

							$fecha_nacimiento = array
							(
								'name'=>'fecha_nacimiento',
								'placeholder'=>'Fecha de Nacimiento',
								'required'=>'required',
								'class'=>'form-control'
							);

							$secciones = array
							(
									'name'=>'secciones',
									'options'=> $this -> secciones,
									'class'=>'form-control'
							);

							$correo = array
							(
									'name'=>'correo',
									'size'=>'80',
									'maxsize'=>'80',
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
									'size'=>'9',
									'maxsize'=>'9',
									'placeholder'=>'Teléfono',
									'class'=>'form-control'
							);

							$telefono_urgencia = array
							(
									'name'=>'telefono_urgencia',
									'size'=>'9',
									'maxsize'=>'9',
									'placeholder'=>'Teléfono de Urgencia',
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
							<?php echo form_input($dni); ?></br>
							<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?>
							<?php echo form_input($nia); ?></br>
							<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?>
							<?php echo form_input($nombre); ?></br>
							<?php echo form_input($fecha_nacimiento); ?></br>
							<?php echo form_label('Sección') ;?></br>
							<?php echo form_dropdown($secciones); ?></br>
							<?php echo form_input($correo); ?></br>
							<?php echo form_label('Género') ;?></br>
							<?php echo form_label('Masculino') ;?>
							<?php echo form_radio($m); ?>
							<?php echo form_label('Femenino') ;?>
							<?php echo form_radio($f); ?></br></br>
							<?php echo form_input($telefono); ?></br>
							<?php echo form_input($telefono_urgencia); ?></br>
							<?php echo form_submit($enviar); ?>
							<?php echo form_close() ;?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
