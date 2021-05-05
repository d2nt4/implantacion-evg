<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Gestión EVG</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<div class="col-12" >
			<h2>Usuario Administrador</h2>
			<?php
			$nombre = array
			(
				'name'=>'nombre',
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$correo = array
			(
				'name'=>'correo',
				'placeholder'=>'Correo',
				'required'=>'required'
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_Instalacion/anadirAdmin');?>
			<?php echo form_input($nombre); ?><br/><br/>
			<?php echo form_input($correo); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
		</div>
	</div>
</div>
</body>
</html>
