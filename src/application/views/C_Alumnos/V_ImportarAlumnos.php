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
			<h2>IMPORTAR ALUMNOS</h2>
			<?php
			$alumnos=array(
				'name'=>'archivo',
				'required'=>'required'
			);
			if(empty($this->secciones))
				echo 'Tiene que haber secciones creadas para importar alumnos';
			else{
			?>
			<?php echo validation_errors();?>
			<?php echo form_open_multipart(base_url().'C_GestionEVG/importarAlumnos');?>
			<?php echo form_upload($alumnos); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?>
			<?php echo form_close();?>
			<?php } ?><br/><br/>
			<a href="<?php echo base_url()?>C_GestionEVG/verAlumnos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
