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
			<h2>IMPORTAR CURSOS</h2>
			<?php
			$cursos=array(
				'name'=>'archivo',
				'required'=>'required'
			);
			?>
			<?php echo validation_errors();?>
			<?php echo form_open_multipart(base_url().'C_GestionEVG/importarCursos');?>
			<?php echo form_upload($cursos); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verCursos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
