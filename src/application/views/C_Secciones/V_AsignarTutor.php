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
			<h2><?php echo $codSeccion?></h2>
			<h3>ASIGNAR/QUITAR TUTOR</h3>
			<h3>Tutor actual: <?php echo $nombreTutor?></h3>
			<?php
			$profesores=array(
				'name'=>'tutor',
				'options'=> $this->profesores
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirQuitarTutor/'.$idSeccion.'/'.$idTutorActual);?>
			<?php echo form_label('Tutor:');?><br/>
			<?php echo form_dropdown($profesores); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verSecciones">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
