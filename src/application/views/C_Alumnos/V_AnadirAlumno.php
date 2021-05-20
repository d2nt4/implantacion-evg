<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Gestión EVG</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<h2>GESTIÓN EVG</h2>
				</header>
			</div>
			<div class="row" id="contenedor">
				<?php include('application/views/Plantilla/asideGestor.php')?>
				<div class="col-9" >
					<h2>NUEVO ALUMNO</h2>
					<?php

						$nia = array
						(
							'name'=>'nia',
							'oninput'=>"buscarCSU('".base_url()."', 'Alumnos', this.value, 'nia', 'infoAjax', 'Ya existe un alumno con el nia ')",
							'placeholder'=>'NIA',
							'required'=>'required'
						);

						$nombre = array
						(
							'name'=>'nombre',
							'placeholder'=>'Nombre',
							'required'=>'required'
						);


						$secciones = array
						(
							'name'=>'secciones',
							'options'=> $this->secciones
						);

						$correo = array
						(
							'name'=>'correo',
							'size'=>'25',
							'maxsize'=>'25',
							'placeholder'=>'Correo'
						);

						$m = array
						(
							'name'  => 'sexo',
							'value' => 'm'
						);

						$f = array
						(
							'name'  => 'sexo',
							'value' => 'f',
							'checked' => 'checked'
						);

						$telefono = array
						(
							'name'=>'telefono',
							'size'=>'25',
							'maxsize'=>'25',
							'placeholder'=>'Teléfono',
							'required'=>'required'
						);
						
						if(empty($this->secciones))
							echo 'Tiene que haber secciones creadas para añadir alumnos';
						else
						{
							?>
							<?php echo validation_errors() ;?>
							<?php echo form_open(base_url().'C_GestionEVG/anadirAlumno') ;?>
							<?php echo form_input($nia); ?>
							<?php echo '<div class="divInfo" id="infoAjax"></div>' ;?></br></br>
							<?php echo form_input($nombre); ?></br></br>
							<?php echo form_label('Sección:') ;?></br>
							<?php echo form_dropdown($secciones); ?></br></br>
							<?php echo form_input($correo); ?></br></br>
							<?php echo form_label('Masculino:') ;?>
							<?php echo form_radio($m); ?>
							<?php echo form_label('Femenino:') ;?>
							<?php echo form_radio($f); ?></br></br>
							<?php echo form_input($telefono); ?></br></br>
							<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?>
							<?php echo form_close() ;?>
							<?php
						} 	?></br></br>
					<?php echo '</br></br><a href="'.base_url().'C_GestionEVG/verAlumnos">Volver</a>' ;?>
				</div>
			</div>
		</div>
	</body>
</html>
