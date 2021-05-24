<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Añadir Familia Profesional</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Familias Profesionales -  Añadir</h3>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verFamilias'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$nombre = array
							(
									'id'=>'nombre',
									'name' => 'nombre',
									'oninput' => "buscarCSU('" . base_url() . "', 'FP_FamiliasProfesionales', this.value, 'nombre', 'infoAjax', 'nombre', 'Ya existe una familia con el nombre ')",
									'placeholder' => 'Nombre',
									'required' => 'required',
									'class'=>'form-control'
							);

							$departamento = array
							(
									'name' => 'departamento',
									'options' => $this->departamentos,
									'class'=>'form-control'
							);

							$enviar = array
							(
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'disabled'=>'disabled',
									'class'=>'form-control'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url() . 'C_GestionEVG/anadirFamilia'); ?>
						<?php echo form_input($nombre); ?>
						<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Departamento'); ?>
						<?php echo form_dropdown($departamento); ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
