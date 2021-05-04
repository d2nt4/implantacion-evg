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
			<div class="row">
				<div class="col-12"><h2><?php echo $nombre?></h2></div>
				<div class="col-6">
					<h3>QUITAR USUARIO</h3>
					<?php
					if(isset($this->usuariosPerfil))
						foreach($this->usuariosPerfil as $indice => $valor)
							echo '<div> '.$valor.'<a href="'.base_url().'C_GestionEVG/quitarUsuarioPerfil/'.$idPerfil.'/'.$indice.'"><button class="btn btn-outline-danger">Quitar</button></a></div>';
					else
						echo 'No hay usuarios asociados';
					?>
				</div>
				<div class="col-6">
					<h3>AÑADIR USUARIO</h3>

					<?php
						$correo=array(
						'name'=>'correo',
						'oninput'=>'buscarUsuarios(\''.base_url().'\','.$idPerfil.', this.value)',
						'onfocusin'=>'document.getElementsByClassName(\'sugerenciaAjax\')[0].style.visibility=\'visible\'',
						'onfocusout'=>'document.getElementsByClassName(\'sugerenciaAjax\')[0].style.visibility=\'hidden\'',
						'required'=>'required',
						'autocomplete'=>'off'
						);
					?>
					<?php echo validation_errors();?>
					<?php echo form_open(base_url().'C_GestionEVG/anadirUsuarioPerfil/'.$idPerfil);?>
					<?php echo form_label('Correo:');?><br/>
					<?php echo form_input($correo); ?>
					<?php echo form_submit('enviar','ENVIAR'); ?><br/><br/>
					<?php echo '<div class="sugerenciaAjax"></div>';?>
					<?php echo form_close();?>
				</div>
				<a href="<?php echo base_url()?>C_GestionEVG/verPerfiles">Volver</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
