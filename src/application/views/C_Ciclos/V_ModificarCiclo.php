<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Modificar Ciclo</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<h3>Ciclos - Modificar Ciclo</h3>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/verCiclos'\" class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Volver atrás\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							$codCiclo = array
							(
									'id'=>'codCiclo',
									'name'=>'codCiclo',
									'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'codCiclo', 'infoAjax', 'codCiclo', 'Ya existe otro ciclo con el código ', '".$this->datosCiclo[0]['codCiclo']."')",
									'value'=>$this->datosCiclo[0]['codCiclo'],
									'required'=>'required',
									'class'=>'form-control'
							);

							$nombre = array
							(
									'id'=>'nombre',
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'FP_Ciclos', this.value, 'nombre', 'infoAjax2', 'nombre', 'Ya existe otro ciclo con el nombre ', '".$this->datosCiclo[0]['nombre']."')",
									'value'=>$this->datosCiclo[0]['nombre'],
									'required'=>'required',
									'class'=>'form-control'
							);

							$familia = array
							(
									'name'=>'familia',
									'options'=> $this->familias,
									'selected' => $idFamilia,
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

						<?php echo validation_errors() ;?>
						<?php echo form_open(base_url().'C_GestionEVG/ModificarCiclo/'.$idCiclo) ;?>
						<?php echo form_label('Código') ;?></br>
						<?php echo form_input($codCiclo); ?>
						<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Nombre') ;?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<small id="infoAjax2" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Familia Profesional') ;?></br>
						<?php echo form_dropdown($familia); ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close() ;?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
