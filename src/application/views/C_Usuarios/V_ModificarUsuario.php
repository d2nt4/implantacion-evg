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
			<h2>MODIFICAR USUARIO</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'value'=>$this->datosUsuario[0]['nombre'],
				'required'=>'required'
			);

			$correo=array(
				'name'=>'correo',
				'oninput'=>"buscarCSU('".base_url()."', 'Usuarios', this.value, 'correo', 'infoAjax', 'Ya existe otro usuario con el correo ', '".$this->datosUsuario[0]['correo']."')",
				'value'=>$this->datosUsuario[0]['correo'],
				'required'=>'required'
			);

			$bajaTemporal=array(
				'name'=>'bajaTemporal'
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarUsuario/'.$idUsuario);?>
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?><br/><br/>
			<?php echo form_label('Correo:');?><br/>
			<?php echo form_input($correo); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_checkbox('bajaTemporal','on',$this->datosUsuario[0]['bajaTemporal'],$bajaTemporal);?>
			<?php echo form_label('Baja temporal');?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verUsuarios">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
