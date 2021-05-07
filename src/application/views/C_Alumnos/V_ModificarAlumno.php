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
			<h2>MODIFICAR ALUMNO</h2>
			<?php

			$nia=array(
				'name'=>'nia',
				'placeholder'=>'NIA',
				'oninput'=>"buscarCSU('".base_url()."', 'Alumnos', this.value, 'nia', 'infoAjax', 'Ya existe otro alumno con el NIA ', '".$this->datosAlumno[0]['NIA']."')",
				'value'=>$this->datosAlumno[0]['NIA'],
				'required'=>'required'
			);

			$nombre=array(
				'name'=>'nombre',
				'placeholder'=>'Nombre',
				'value'=>$this->datosAlumno[0]['nombre']
			);


			$secciones=array(
				'name'=>'secciones',
				'options'=> $this->secciones,
				'selected'=>$this->datosAlumno[0]['idSeccion']
			);

			$correo=array(
				'name'=>'correo',
				'placeholder'=>'Correo',
				'value'=>$this->datosAlumno[0]['correo']
			);

			if($this->datosAlumno[0]['sexo']=='m'){
				$m = array(
					'name'  => 'sexo',
					'value' => 'm',
					'checked' => TRUE
				);

				$f = array(
					'name'  => 'sexo',
					'value' => 'f'
				);
			}
			else{
				$m = array(
					'name'  => 'sexo',
					'value' => 'm'
				);

				$f = array(
					'name'  => 'sexo',
					'value' => 'f',
					'checked' => TRUE
				);
			}



			$telefono=array(
				'name'=>'telefono',
				'placeholder'=>'Teléfono',
				'value'=>$this->datosAlumno[0]['telefono']
			);


			?>
			<?php echo validation_errors();?>
			<?php echo form_open(base_url().'C_GestionEVG/modificarAlumno/'.$idAlumno.'/'.$this->datosAlumno[0]['idSeccion'].'/'.$idEtapa);?>
			<?php echo form_label('NIA:');?><br/>
			<?php echo form_input($nia); ?>
			<?php echo '<div class="divInfo" id="infoAjax"></div>';?><br/><br/>
			<?php echo form_label('Nombre:');?><br/>
			<?php echo form_input($nombre); ?><br/><br/>
			<?php echo form_label('Sección:');?><br/>
			<?php echo form_dropdown($secciones); ?><br/><br/>
			<?php echo form_label('Correo:');?><br/>
			<?php echo form_input($correo); ?><br/><br/>
			<?php echo form_label('Masculino:');?>
			<?php echo form_radio($m); ?>
			<?php echo form_label('Femenino:');?>
			<?php echo form_radio($f); ?><br/><br/>
			<?php echo form_label('Teléfono:');?><br/>
			<?php echo form_input($telefono); ?><br/><br/>
			<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
			<?php echo form_close();?>
			<?php echo '<a href="'.base_url().'C_GestionEVG/verAlumnosSeccion/'.$this->datosAlumno[0]['idSeccion'].'/'.$idEtapa.'">Volver</a>'?>
		</div>
	</div>
</div>
</body>
</html>
