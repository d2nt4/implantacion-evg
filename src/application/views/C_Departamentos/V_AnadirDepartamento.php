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
			<h2>NUEVO DEPARTAMENTO</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'FP_Departamentos', this.value, 'nombre', 'infoAjax', 'Ya existe un departamento con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirDepartamento');?>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verDepartamentos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
