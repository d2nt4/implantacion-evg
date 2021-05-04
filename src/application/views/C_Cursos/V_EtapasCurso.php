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
			<h2>ASIGNAR ETAPA</h2>
			<h2 class="col-12"><?php echo $codCurso?></h2>
			<?php
			$etapas=array(
				'name'=>'etapa',
				'options'=>$this->etapas,
				'selected'=>$idEtapa
			);

			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/asignarEtapaCurso/'.$idCurso);?><!--está bien pero php torm no  -->
			<?php echo form_label('Etapa:');?><br/>
			<?php echo form_dropdown($etapas); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<a href="<?php echo base_url()?>C_GestionEVG/verCursos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
