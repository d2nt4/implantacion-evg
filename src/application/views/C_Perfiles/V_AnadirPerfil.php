<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Administración EVG</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideAdmin.php') ?>
		<div class="col-9" >
			<h2>NUEVO PERFIL</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'Perfiles', this.value, 'nombre', 'infoAjax', 'Ya existe un perfil con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$descripcion=array(
				'name'=>'descripcion',
				'placeholder'=>'Descripción',
				'required'=>'required'
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirPerfil');?>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?><br/><br/>
			<?php echo form_input($descripcion); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verPerfiles">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
