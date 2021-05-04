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
			buscarCSU('<?php echo base_url();?>', 'cursos', '', 'codCurso', 'infoAjax', ' ');
			buscarCSU('<?php echo base_url();?>', 'cursos', '', 'nombre', 'infoAjax2', ' ');
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
			<h2>NUEVO CURSO</h2>
			<?php
			$codCurso=array(
				'name'=>'codCurso',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'codCurso', 'infoAjax', 'Ya existe un curso con el código ')",
				'placeholder'=>'Código',
				'required'=>'required'
			);

			$idCursoColegio=array(
				'name'=>'idCursoColegio',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'idCursoColegio', 'infoAjax2', 'Ya existe un curso con el id ')",
				'placeholder'=>'Identificador de curso del colegio'
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'nombre', 'infoAjax3', 'Ya existe un curso con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirCurso');?>
			<?php echo form_input($codCurso);?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_input($idCursoColegio);?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_input($nombre);?>
			<?php echo '<div class="divInfo" id="infoAjax3"></div>';?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verCursos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
