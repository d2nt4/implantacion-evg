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
			<h2>MODIFICAR CURSO</h2>
			<?php
			$codCurso=array(
				'name'=>'codCurso',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'codCurso', 'infoAjax', 'Ya existe otro curso con el código ', '".$this->datosCurso[0]['codCurso']."')",
				'value'=>$this->datosCurso[0]['codCurso']
			);

			$idCursoColegio=array(
				'name'=>'idCursoColegio',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'idCursoColegio', 'infoAjax2', 'Ya existe un curso con el id , '".$this->datosCurso[0]['idCursoColegio']."')",
				'value'=>$this->datosCurso[0]['idCursoColegio']
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'cursos', this.value, 'nombre', 'infoAjax3', 'Ya existe otro curso con el nombre ', '".$this->datosCurso[0]['nombre']."')",
				'value'=>$this->datosCurso[0]['nombre']
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarCurso/'.$idCurso);?>
			<?php echo form_label('Código:');?><br/>
			<?php echo form_input($codCurso); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Identificador de curso del colegio:');?><br/>
			<?php echo form_input($idCursoColegio);?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax3"></div>';?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verCursos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
