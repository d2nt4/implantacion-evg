<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Etapas Cursos</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<?php echo "<h3>Etapas Cursos - ".$codCurso."</h3>"; ?>
					</div>
					<div class="col-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Aplicaciones\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include_once('application/views/Plantilla/asideGestor.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars" data-toggle="popover" data-content="Mostrar menú"></i>
						<i class="fas fa-times" data-toggle="popover" data-content="Ocultar menú"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/VerCursos'\" class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Volver atrás\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$etapas = array
							(
									'name'=>'etapa',
									'options'=>$this->etapas,
									'selected'=>$idEtapa,
									'class'=>'form-control'
							);

							$enviar = array
							(
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'class'=>'form-control'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/asignarEtapaCurso/'.$idCurso); ?>
						<?php echo form_label('Etapa'); ?>
						<?php echo form_dropdown($etapas); ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
