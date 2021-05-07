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
			buscarCSU('<?php echo base_url();?>', 'Etapas', '', 'codEtapa', 'infoAjax', ' ');
			buscarCSU('<?php echo base_url();?>', 'Etapas', '', 'nombre', 'infoAjax2', ' ');
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
			<h2>NUEVA ETAPA</h2>
			<?php
			$codEtapa=array(
				'name'=>'codEtapa',
				'oninput'=>"buscarCSU('".base_url()."', 'Etapas', this.value, 'codEtapa', 'infoAjax', 'Ya existe una etapa con el código ')",
				'placeholder'=>'Código',
				'required'=>'required'
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'Etapas', this.value, 'nombre', 'infoAjax2', 'Ya existe una etapa con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$idCoordinador=array(
				'name'=>'idCoordinador',
				'options'=> $this->usuarios
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirEtapa');?>
			<?php echo form_input($codEtapa); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_label('Coordinador:');?><br/>
			<?php echo form_dropdown($idCoordinador); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verEtapas">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
