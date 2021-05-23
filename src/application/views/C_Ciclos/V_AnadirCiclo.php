<?php
	include('application/views/Plantilla/header.php');
?>

<html>
	<head>
		<title>Añadir Ciclo</title>
		<script>
			function pruebaInicial()
			{// Tendrá que haber en esta función tantas líneas como distintos id de texto de ajax haya en la página
				buscarCSU('<?php echo base_url() ;?>', 'FP_Ciclos', '', 'codCiclo', 'infoAjax', ' ');
				buscarCSU('<?php echo base_url() ;?>', 'FP_Ciclos', '', 'nombre', 'infoAjax2', ' ');
			}
		</script>
	</head>
	<body onload="pruebaInicial()">
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Ciclos - Añadir Ciclo</h3>
					</div>
					<div class="col-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/'\" id=\"icon-grid\" class=\"btn mr-2\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include('application/views/Plantilla/asideGestor.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verCiclos'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$codCiclo = array
							(
									'name'=>'codCiclo',
									'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'codCiclo', 'infoAjax', 'Ya existe un ciclo con el código ')",
									'placeholder'=>'Código',
									'required'=>'required',
									'class'=>'form-control'
							);

							$nombre = array
							(
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'nombre', 'infoAjax2', 'Ya existe un ciclo con el nombre ')",
									'placeholder'=>'Nombre',
									'required'=>'required'
							);

							$familia = array
							(
									'name'=>'familia',
									'options'=> $this->familias
							);
						?>

						<?php echo validation_errors() ;?>
						<?php echo form_open(base_url().'C_GestionEVG/anadirCiclo') ;?>
						<?php echo form_input($codCiclo); ?>
						<?php echo '<div id="infoAjax" class="divInfo"></div>' ;?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<div id="infoAjax2" class="divInfo"></div>' ;?></br>
						<?php echo form_label('Familia Profesional:') ;?>
						<?php echo form_dropdown($familia); ?></br>
						<?php echo '<div class="submit-container">'.form_submit('enviar','ENVIAR', disabled).'</div>'; ?>
						<?php echo form_close() ;?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
