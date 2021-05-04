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
			<h2>NUEVA FAMILIA PROFESIONAL</h2>
			<?php

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'fp_familiasprofesionales', this.value, 'nombre', 'infoAjax', 'Ya existe una familia con el nombre ')",
				'placeholder'=>'Nombre',
				'required'=>'required'
			);

			$departamento=array(
				'name'=>'departamento',
				'options'=> $this->departamentos
			);
			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/anadirFamilia');?>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Departamento:');?><br/>
			<?php echo form_dropdown($departamento); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR', 'disabled'); ?>
			<?php echo form_close();?><br/><br/>
			<a href="<?php echo base_url()?>C_GestionEVG/verFamilias">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
