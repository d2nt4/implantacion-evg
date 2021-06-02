<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>EVG</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Añadir Administrador</h3>
					</div>
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
					</div>
				</header>
			</div>
			<div class="row">
				<div class="general">
					<div class="gestion-apps">
						<?php
							$nombre = array
							(
									'name'=>'nombre',
									'placeholder'=>'Nombre',
									'required'=>'required',
									'class'=>'form-control'
							);

							$correo = array
							(
									'name'=>'correo',
									'placeholder'=>'Correo',
									'required'=>'required',
									'class'=>'form-control'
							);

							$enviar = array
							(
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'class'=>'form-control'
							);
						?>

						<?php echo validation_errors() ;?>
						<?php echo form_open(base_url().'C_Instalacion/anadirAdmin') ;?>
						<?php echo form_input($nombre); ?></br>
						<?php echo form_input($correo); ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close() ;?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
