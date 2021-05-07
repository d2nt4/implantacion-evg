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
			<h2>GESTIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideGestor.php') ?>
		<div class="col-9" >
			<h2>NUEVO USUARIO</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$correo=array(
				'name'=>'correo',
				'oninput'=>"buscarCSU('".base_url()."', 'Usuarios', this.value, 'correo', 'infoAjax', 'Ya existe un usuario con el correo ')",
				'placeholder'=>'Correo',
				'required'=>'required'
			);

			$profesor=array(
				'name'=>'profesor'
			);
			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirUsuario');?>
			<?php echo form_input($nombre); ?><br/><br/>
			<?php echo form_input($correo); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_checkbox('profesor','on',false,$profesor);?>
			<?php echo form_label('Es profesor');?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verUsuarios">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
