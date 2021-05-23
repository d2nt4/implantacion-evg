<?php
	include('application/views/Plantilla/header.php');
?>

<html>
	<head>
		<title>Ciclos Cursos</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'; ?>
						<?php echo "<h3>Ciclos Cursos - ".$codCiclo."</h3>"; ?>
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
					<div class="gestiones">
						<div class="gestion-apps">
							<h3 class="font-weight-bolder">QUITAR CURSO DEL CICLO</h3>
							<?php
								if(isset($this->ciclosCurso))
									foreach($this->ciclosCurso as $indice => $valor)
										echo '<div>'.$valor.'<a href="'.base_url().'C_GestionEVG/quitarCursoCiclo/'.$idCiclo.'/'.$indice.'"><button  class="btn btn-outline-danger">Quitar</button></a></div>';
								else
									echo 'No hay cursos de este ciclo';
							?>
						</div>
						<div class="gestion-apps">
							<h3 class="font-weight-bolder">AÑADIR CURSO AL CICLO</h3>
							<?php
								if(isset($this->cursosNoCiclo))
									foreach($this->cursosNoCiclo as $indice => $valor)
										echo '<div>'.$valor.'<a href="'.base_url().'C_GestionEVG/anadirCursoCiclo/'.$idCiclo.'/'.$indice.'"><button class="btn btn-outline-success">Añadir</button></a></div>';
								else
									echo 'No hay cursos disponibles para añadir';
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
