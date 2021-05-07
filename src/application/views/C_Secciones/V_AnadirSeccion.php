<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Gestión EVG</title>
	<script>
		function pruebaInicial()
		{// tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página
			// se podría mejorar creando los id desde javascript directamente
			buscarCSU('<?php echo base_url();?>', 'Secciones', '', 'codSeccion', 'infoAjax', ' ');
			buscarCSU('<?php echo base_url();?>', 'Secciones', '', 'idSeccionCurso', 'infoAjax2', ' ');

		}// hago esto para que se inicialice el array que contiene la información de los id que deben ser correctos, si no, puede dar fallos
	</script>
</head>
<body onload="pruebaInicial()">
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>GESTIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideGestor.php') ?>
		<div class="col-9" >
			<h2>NUEVA SECCIÓN</h2>
			<?php

			$codSeccion=array(
				'name'=>'codSeccion',
				'oninput'=>"buscarCSU('".base_url()."', 'Secciones', this.value, 'codSeccion', 'infoAjax', 'Ya existe una sección con el código ')",
				'placeholder'=>'Código',
				'required'=>'required'
			);

			$idSeccionColegio=array(
				'name'=>'idSeccionColegio',
				'oninput'=>"buscarCSU('".base_url()."', 'Secciones', this.value, 'idSeccionColegio', 'infoAjax2', 'Ya existe una sección con el identificador ')",
				'placeholder'=>'Identificador de sección del colegio'
			);

			$nombre=array(
				'name'=>'nombre',
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$cursos=array(
				'name'=>'curso',
				'options'=> $this->cursos
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirSeccion');?>
			<?php echo form_input($codSeccion); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_input($idSeccionColegio); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_input($nombre); ?><br/><br/>
			<?php echo form_label('Curso:');?><br/>
			<?php echo form_dropdown($cursos); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verSecciones">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
