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
			<h2>MODIFICAR CICLO</h2>
			<?php
			$codCiclo=array(
				'name'=>'codCiclo',
				'oninput'=>"buscarCSU('".base_url()."', 'fp_ciclos', this.value, 'codCiclo', 'infoAjax', 'Ya existe otro ciclo con el código ', '".$this->datosCiclo[0]['codCiclo']."')",
				'value'=>$this->datosCiclo[0]['codCiclo'],
				'required'=>'required'
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'fp_ciclos', this.value, 'nombre', 'infoAjax2', 'Ya existe otro ciclo con el nombre ', '".$this->datosCiclo[0]['nombre']."')",
				'value'=>$this->datosCiclo[0]['nombre'],
				'required'=>'required'
			);

			$familia=array(
				'name'=>'familia',
				'options'=> $this->familias,
				'selected' => $idFamilia
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/ModificarCiclo/'.$idCiclo);?>
			<?php echo form_label('Código:');?><br/>
			<?php echo form_input($codCiclo); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_label('Familia Profesional:');?><br/>
			<?php echo form_dropdown($familia); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verCiclos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
