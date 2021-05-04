<?php
include('application/views/Plantilla/header.php');
?>


<html>
<head>
	<title>Gestión EVG</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>GESTIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideGestor.php') ?>
		<div class="col-9" >
			<h2>USUARIOS</h2>
			<?php
			echo "<a href='".base_url()."C_GestionEVG/importarUsuariosForm' tabindex='-1'><button>Importar usuarios</button></a>";
			echo "<a href='".base_url()."C_GestionEVG/anadirUsuarioForm' tabindex='-1'><button id='anadir'>Nuevo usuario</button></a><table>";
			foreach($this->listaUsuarios as $indice => $valor)
				echo '<tr><td><p id="valor"> '.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/modificarUsuarioForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el usuario: '.$valor.'?\',\''.base_url().'C_GestionEVG/borrarUsuario/'.$indice.'\')">Borrar</button></td></tr>';
			echo '</table>'
			?>
		</div>
	</div>
</div>
</body>
</html>
