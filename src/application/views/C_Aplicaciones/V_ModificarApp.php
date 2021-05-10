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
					<h2>MODIFICAR APLICACIÓN</h2>
					<?php
						$nombre = array
						(
							'name'=>'nombre',
							'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'nombre', 'infoAjax', 'Ya existe otra aplicación con el nombre ', '".$this->datosApp[0]['nombre']."')",
							'value'=>$this->datosApp[0]['nombre'],
							'required'=>'required'
						);

						$descripcion = array
						(
							'name'=>'descripcion',
							'value'=>$this->datosApp[0]['descripcion'],
							'required'=>'required'
						);

						$url = array
						(
							'name'=>'url',
							'oninput'=>"buscarCSU('".base_url()."', 'Aplicaciones', this.value, 'url', 'infoAjax2', 'Ya existe otra aplicación con la url ', '".$this->datosApp[0]['url']."')",
							'value'=>$this->datosApp[0]['url'],
							'required'=>'required'
						);

						$icono = array
						(
							'name'=>'icono'
						);
					?>
					<?php echo validation_errors();?>
					<?php echo form_open_multipart(base_url().'C_GestionEVG/modificarApp/'.$idAplicacion);?><!--está bien pero phpstorm no lo ve desde aquí -->
					<?php echo form_label('Nombre:');?><br/>
					<?php echo form_input($nombre); ?>
					<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
					<?php echo form_label('Descripción:');?><br/>
					<?php echo form_input($descripcion); ?><br/><br/>
					<?php echo form_label('URL de acceso:');?><br/>
					<?php echo form_input($url); ?>
					<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
					<?php echo form_label('Icono:');?><br/>
					<?php echo form_upload($icono); ?><br/><br/>
					<?php if(!empty($this->datosApp[0]['icono'])) echo '<img id="iconoApp" src="../../uploads/iconos/'.$this->datosApp[0]['icono'].'"/>' ?><br/><br/>
					<?php echo form_submit('enviar','ENVIAR');?><br/><br/>
					<?php echo form_close();?>
					<a href="<?php echo base_url()?>C_GestionEVG/verApps">Volver</a>
				</div>
			</div>
		</div>
	</body>
</html>
