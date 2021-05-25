<aside>
	<div class="wrapper">
		<nav id="sidebar" class="active">
			<div class="sidebar-header">
				<?php
					$name = $this -> session -> userdata('name');
					echo "<h5 class='font-weight-bolder'>".$name."</h5>";
				?>
			</div>

			<ul class="list-unstyled components">
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerUsuarios'>Usuarios</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerEtapas'>Etapas</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerCursos'>Cursos</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerDepartamentos'>Departamentos</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerFamilias'>Familias Profesionales</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerCiclos'>Ciclos</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerSecciones'>Secciones</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerAlumnos'>Alumnos</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a target='blank' href='".base_url()."C_GestionEVG/listadoTutores'>Listado de tutores</a></br>"; ?>
				</li>
				<li>
					<?php echo "<a href =\"#\" onclick=\"modalCheck('¿Seguro que quieres iniciar un nuevo curso?. Se borrarán todos los alumnos. ESTA ACCIÓN ES IRREVERSIBLE','".base_url()."C_GestionEVG/nuevoCurso', 'Iniciar Nuevo Curso', '¿Desea comenzar un nuevo curso?', 'Cancelar', 'Iniciar')\" onkeypress=\"if (event.keyCode===13) modalCheck('¿Seguro que quieres iniciar un nuevo curso? Se borrarán todos los alumnos','".base_url()."C_GestionEVG/nuevoCurso', 'Iniciar Nuevo Curso', 'Cancelar', 'Iniciar')\" tabindex='0' data-toggle=\"modal\" data-target=\"#check\">Comienzo de Curso</a>"; ?>
				</li>
			</ul>

<!--			<ul class="list-unstyled CTAs">-->
<!--				<li>-->
<!--					<a href="#" class="download">Botón 1</a>-->
<!--				</li>-->
<!--				<li>-->
<!--					<a href="#" class="article">Botón 2</a>-->
<!--				</li>-->
<!--			</ul>-->
		</nav>
	</div>
</aside>
