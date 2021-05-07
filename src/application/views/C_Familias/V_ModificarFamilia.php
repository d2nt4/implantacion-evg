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
			<h2>MODIFICAR Familia</h2>
			<?php
			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'FP_FamiliasProfesionales', this.value, 'nombre', 'infoAjax', 'Ya existe una familia profesional con el nombre ', '".$this->datosFamilia[0]['nombre']."')",
				'value'=>$this->datosFamilia[0]['nombre'],
				'required'=>'required'
			);

			$departamento=array(
				'name'=>'departamento',
				'options'=>$this->departamentos,
				'selected' => $idDepartamento
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarFamilia/'.$idFamilia);?><!--está bien pero php storm no lo coge -->
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Departamento:');?><br/>
			<?php echo form_dropdown($departamento); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verFamilias">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
