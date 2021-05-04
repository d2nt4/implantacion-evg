<aside class="col-3">
	<?php
	echo "<a href='".base_url()."C_GestionEVG/VerUsuarios'>Usuarios</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerEtapas'>Etapas</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerCursos'>Cursos</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerDepartamentos'>Departamentos</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerFamilias'>Familias Profesionales</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerCiclos'>Ciclos</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerSecciones'>Secciones</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerAlumnos'>Alumnos</a><br/>";
	echo "<a target='blank' href='".base_url()."C_GestionEVG/listadoTutores'>Listado de tutores</a><br/>";
	echo "<a onclick=\"confirmar('¿Seguro que quieres iniciar un nuevo curso?\\n Se borrarán todos los alumnos.\\n ESTA ACCIÓN ES IRREVERSIBLE.','".base_url()."C_GestionEVG/nuevoCurso')\" onkeypress=\"if (event.keyCode===13) confirmar('¿Seguro que quieres iniciar un nuevo curso?\\n se borrarán todos los alumnos, esta acción es irreversible.','".base_url()."C_GestionEVG/nuevoCurso')\" tabindex='0'>Comienzo de Curso</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/'>Mis aplicaciones</a><br/>";
	echo "<a id='cerrarSesionAside' onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout')\" onkeypress=\"if (event.keyCode===13) confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout')\" tabindex='0'>Cerrar sesión</a><br/>";// el onkeypress es para que cuando se pulse enter (keycode===13) se active la misma función que al hacer click en el a
	?>
</aside>
