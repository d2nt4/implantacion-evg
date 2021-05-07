<?php
	include('application/views/Plantilla/header.php');
?>
<html>
<head>
	<title>Administración EVG</title>
	<script>
		function pruebaInicial()
		{// tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página
			// se podría mejorar creando los id desde javascript directamente
			buscarCSU('<?php echo base_url();?>', 'Aplicaciones', '', 'url', 'infoAjax', ' ');
			buscarCSU('<?php echo base_url();?>', 'Aplicaciones', '', 'nombre', 'infoAjax2', ' ');
		}// hago esto para que se inicialice el array que contiene la información de los id que deben ser correctos, si no, puede dar fallos
	</script>
</head>
<body onload="pruebaInicial()">
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideAdmin.php') ?>
		<div class="col-9" >
			<h2>NUEVA APLICACIÓN</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'nombre', 'infoAjax', 'Ya existe una aplicación con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$descripcion=array(
				'name'=>'descripcion',
				'placeholder'=>'Descripción',
				'required'=>'required'
			);

			$url=array(
				'name'=>'url',
				'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'url', 'infoAjax2', 'Ya existe una aplicación con la URL ')",
				'placeholder'=>'URL de acceso',
				'required'=>'required'
			);

			$icono=array(
				'name'=>'icono',
				'required'=>'required'
			);
			?>
			<?php echo validation_errors();?>
			<?php echo form_open_multipart(base_url().'C_GestionEVG/anadirAPP');?>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?><br/><br/>
			<?php echo form_input($descripcion); ?><br/><br/>
			<?php echo form_input($url); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>'; ?><br/><br/>
			<?php echo form_label('Icono:');?><br/>
			<?php echo form_upload($icono); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verApps">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
