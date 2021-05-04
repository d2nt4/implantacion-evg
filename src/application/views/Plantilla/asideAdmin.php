<aside class="col-3">
	<?php
	echo "<a href='".base_url()."C_GestionEVG/VerApps'>Aplicaciones</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/VerPerfiles'>Perfiles</a><br/>";
	echo "<a href='".base_url()."C_GestionEVG/'>Mis aplicaciones</a><br/>";
	echo "<a id='cerrarSesionAside' onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout')\" onkeypress=\"if (event.keyCode===13) confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout')\" tabindex='0'>Cerrar sesión</a><br/>";// el onkeypress es para que cuando se pulse enter (keycode===13) se active la misma función que al hacer click en a
	?>
</aside>
