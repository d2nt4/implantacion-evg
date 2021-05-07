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
			buscarCSU('<?php echo base_url();?>', 'FP_Ciclos', '', 'codCiclo', 'infoAjax', ' ');
			buscarCSU('<?php echo base_url();?>', 'FP_Ciclos', '', 'nombre', 'infoAjax2', ' ');
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
			<h2>NUEVO CICLO</h2>
			<?php

			$codCiclo=array(
				'name'=>'codCiclo',
				'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'codCiclo', 'infoAjax', 'Ya existe un ciclo con el código ')",
				'placeholder'=>'Código',
				'required'=>'required'
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'nombre', 'infoAjax2', 'Ya existe un ciclo con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$familia=array(
				'name'=>'familia',
				'options'=> $this->familias
			);
			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirCiclo');?>
			<?php echo form_input($codCiclo); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_label('Familia Profesional:');?><br/>
			<?php echo form_dropdown($familia); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?>
			<?php echo form_close();?><br/><br/>
			<a href="<?php echo base_url()?>C_GestionEVG/verCiclos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
