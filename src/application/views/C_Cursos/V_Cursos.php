<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Cursos</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Gestión EVG - Cursos</h3>
					</div>
					<div class="col-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Apliciones\"><i class=\"fas fa-th\"></i></button>"; ?>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/anadirCursoForm'\" class=\"btn btn-success\" data-toggle=\"popover\" data-content=\"Añadir Curso\"><i class=\"fas fa-plus-square\"></i></button>"; ?>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/importarCursosForm'\" class=\"btn btn-warning\" data-toggle=\"popover\" data-content=\"Importar Cursos\"><i class=\"fas fa-file-import\"></i></button>"; ?>
					<div class="gestion-apps">
						<?php
							foreach($this -> listaCursos as $indice => $valor)
							{
								echo
										"
									<div class=\"fila\">
										<h3>" . $valor . "</h3>
										<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/asignarEtapaCursoForm/" . $indice . "'\" class=\"btn btn-info\" data-toggle=\"popover\" data-content=\"Asignar Etapa\"><i class=\"fas fa-cog\"></i></button>
										<button onclick=\"location.href ='" . base_url() . "C_GestionEVG/modificarCursoForm/" . $indice . "'\" class=\"btn btn-warning\" data-toggle=\"popover\" data-content=\"Modificar Curso\"><i class=\"fas fa-edit\"></i></button>
										<button onclick=\"confirmar('¿Seguro que quieres borrar el curso: <b>" . $valor . "</b>?', '" . base_url() . "C_GestionEVG/borrarCurso/" . $indice . "', 'Eliminar Curso', 'Cancelar', 'Eliminar')\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fas fa-trash\"></i></button>";
								if (!is_null($this->listaEtapasCursos[$indice]))
									echo "
										<button class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Ya hay una etapa asignada\"><i class=\"fas fa-exclamation-circle\"></i></button>
									</div>						
								";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
