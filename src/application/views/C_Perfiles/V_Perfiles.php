<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Administración EVG</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideAdmin.php') ?>
		<div class="col-9" >
			<h2>PERFILES</h2>
			<?php
			echo "<a href='".base_url()."C_GestionEVG/anadirPerfilForm' tabindex='-1'><button id='anadir'>Nuevo perfil</button></a><table>";
			foreach($this->listaPerfiles as $indice => $valor)
				echo '<tr><td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/usuariosPerfil/'.$indice.'" tabindex=\'-1\'><button>Usuarios asociados</button></a><a href="'.base_url().'C_GestionEVG/modificarPerfilForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el perfil: '.$valor.'?\',\''.base_url().'C_GestionEVG/borrarPerfil/'.$indice.'\')">Borrar</button></td></tr>';
			echo '</table>';
			?>
		</div>
	</div>
</div>
</body>
</html>
