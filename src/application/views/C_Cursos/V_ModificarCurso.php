<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Modificar Curso</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<?php echo "<h3>Modificar Curso - ".$this->datosCurso[0]['nombre']."</h3>"; ?>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/VerCursos'\" class=\"btn btn-secondary\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$codCurso = array
							(
									'name'=>'codCurso',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'codCurso', 'infoAjax', 'Ya existe otro curso con el código ', '".$this->datosCurso[0]['codCurso']."')",
									'value'=>$this->datosCurso[0]['codCurso']
							);

							$idCursoColegio = array
							(
									'name'=>'idCursoColegio',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'idCursoColegio', 'infoAjax2', 'Ya existe un curso con el id , '".$this->datosCurso[0]['idCursoColegio']."')",
									'value'=>$this->datosCurso[0]['idCursoColegio']
							);

							$nombre = array
							(
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'Cursos', this.value, 'nombre', 'infoAjax3', 'Ya existe otro curso con el nombre ', '".$this->datosCurso[0]['nombre']."')",
									'value'=>$this->datosCurso[0]['nombre']
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/modificarCurso/'.$idCurso) ;?>
						<?php echo form_label('Código'); ?></br>
						<?php echo form_input($codCurso); ?>
						<?php echo '<div class="divInfo" id="infoAjax"></div>'; ?></br>
						<?php echo form_label('Identificador de curso del colegio'); ?></br>
						<?php echo form_input($idCursoColegio); ?>
						<?php echo '<div class="divInfo" id="infoAjax2"></div>'; ?></br>
						<?php echo form_label('Nombre'); ?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<div class="divInfo" id="infoAjax3"></div>'; ?></br>
						<?php echo '<div class="submit-container">'.form_submit('enviar','ENVIAR').'</div>'; ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
