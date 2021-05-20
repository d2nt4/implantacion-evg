<?php
	include('application/views/Plantilla/header.php');
?>
<html>
	<head>
		<title>Departamentos</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Gestión EVG - Departamentos</h3>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/anadirDepartamentoForm'\" class=\"btn btn-success\"><i class=\"fas fa-plus-square\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							foreach($this->listaDepartamentos as $indice => $valor)
								echo
										"
									<div class=\"fila\">
										<h3>".$valor."</h3>							
										<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/modificarDepartamentoForm/".$indice."'\" class=\"btn btn-warning\"><i class=\"fas fa-edit\"></i></button>
										<button onclick=\"confirmar('¿Seguro que quieres borrar el departamento: <b>".$valor."</b>?', '".base_url()."C_GestionEVG/borrarDepartamento/".$indice."', 'Eliminar Departamento', 'Cancelar', 'Eliminar')\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fas fa-trash\"></i></button>													
									</div>						
								";
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
