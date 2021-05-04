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
			<h2>MODIFICAR ETAPA</h2>
			<?php
			$codEtapa=array(
				'name'=>'codEtapa',
				'oninput'=>"buscarCSU('".base_url()."', 'etapas', this.value, 'codEtapa', 'infoAjax', 'Ya existe otra etapa con el código ', '".$this->datosEtapa[0]['codEtapa']."')",
				'value' => $this->datosEtapa[0]['codEtapa'],
				'required'=>'required'
			);

			$nombre=array(
				'name'=>'nombre',
				'oninput'=>"buscarCSU('".base_url()."', 'etapas', this.value, 'nombre', 'infoAjax2', 'Ya existe otra etapa con el nombre ', '".$this->datosEtapa[0]['nombre']."')",
				'value'=>$this->datosEtapa[0]['nombre'],
				'required'=>'required'
			);

			if($this->datosEtapa[0]['idCoordinador']==null)
				$this->datosEtapa[0]['idCoordinador']=0;

			$idCoordinador=array(
				'name'=>'idCoordinador',
				'options'=> $this->usuarios,
				'selected'=>$this->datosEtapa[0]['idCoordinador'],
				'required'=>'required'
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarEtapa/'.$idEtapa);?>
			<?php echo form_label('Código:');?><br/>
			<?php echo form_input($codEtapa); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?>
			<?php echo '<div class="divInfo" id="infoAjax2"></div>';?><br/><br/>
			<?php echo form_label('Coordinador:');?><br/>
			<?php echo form_dropdown($idCoordinador); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verEtapas">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
