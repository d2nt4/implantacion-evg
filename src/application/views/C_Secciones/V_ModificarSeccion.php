<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Gestión EVG</title>
</head>
<body>
<div id="principal" class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>GESTIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideGestor.php') ?>
		<div class="col-9" >
			<h2>MODIFICAR SECCIÓN</h2>
			<div id="infoAjax"></div>
			<div id="infoAjax2"></div>
			<?php

			$codSeccion=array(
				'name'=>'codSeccion',
				'oninput'=>"buscarCSU('".base_url()."', 'Secciones', this.value, 'codSeccion', 'infoAjax', 'Ya existe otra sección con el código ', '".$this->datosSeccion[0]['codSeccion']."')",
				'value'=>$this->datosSeccion[0]['codSeccion'],
				'required'=>'required'
			);

			$idSeccionColegio=array(
				'name'=>'idSeccionColegio',
				'oninput'=>"buscarCSU('".base_url()."', 'Secciones', this.value, 'idSeccionColegio', 'infoAjax2', 'Ya existe otra sección con el identificador '', '".$this->datosSeccion[0]['idSeccionColegio'].")",
				'value'=>$this->datosSeccion[0]['idSeccionColegio']
			);

			$nombre=array(
				'name'=>'nombre',
				'value'=>$this->datosSeccion[0]['nombre'],
				'required'=>'required'
			);

			$curso=array(
				'name'=>'curso',
				'options'=> $this->cursos,
				'selected' => $idCurso
			);

			?>
			<?php echo validation_errors() ;?>
			<?php echo form_open(base_url().'C_GestionEVG/ModificarSeccion/'.$idSeccion) ;?>
			<?php echo form_label('Código:') ;?></br>
			<?php echo form_input($codSeccion); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>' ;?></br></br>
			<?php echo form_label('Identificador de sección del colegio:') ;?></br>
			<?php echo form_input($idSeccionColegio); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>' ;?></br></br>
			<?php echo form_label('Nombre:') ;?></br>
			<?php echo form_input($nombre); ?></br></br>
			<?php echo form_label('Curso:') ;?></br>
			<?php echo form_dropdown($curso); ?></br></br>
			<?php echo form_submit('enviar','ENVIAR'); ?></br></br>
			<?php echo form_close() ;?>
			<a href="<?php echo base_url()?>C_GestionEVG/verSecciones">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
