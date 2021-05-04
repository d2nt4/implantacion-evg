<?php
include('application/views/Plantilla/header.php');
?>
<html>
<head>
	<title>Administración EVG</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideAdmin.php') ?>
		<div class="col-9" >
			<h2>MODIFICAR PERFIL</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'perfiles', this.value, 'nombre', 'infoAjax', 'Ya existe otro perfil con el nombre ', '".$this->datosPerfil[0]['nombre']."')",
				'value'=>$this->datosPerfil[0]['nombre'],
				'required'=>'required'
			);

			$descripcion=array(
				'name'=>'descripcion',
				'value'=>$this->datosPerfil[0]['descripcion'],
				'required'=>'required'
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarPerfil/'.$idPerfil);?><!--está bien pero php storm no  -->
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?><br/><br/>
			<?php echo form_label('Descripción:');?><br/>
			<?php echo form_input($descripcion); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verPerfiles">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
