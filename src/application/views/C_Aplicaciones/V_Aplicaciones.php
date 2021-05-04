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
			<h2>APLICACIONES</h2>
			<?php
				echo "<a href='".base_url()."C_GestionEVG/anadirAppForm' tabindex='-1'><button id='anadir'>Nueva aplicación</button></a><table>";
				foreach($this->listaApps as $indice => $valor)
					echo '<tr> <td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/perfilesAplicacion/'.$indice.'" tabindex=\'-1\'><button>Añadir/quitar perfil</button></a><a href="'.base_url().'C_GestionEVG/modificarAppForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar la aplicación: '.$valor.'?\',\''.base_url().'C_GestionEVG/borrarApp/'.$indice.'\')">Borrar</button></td></tr>';
				echo '</table>';
			?>
		</div>
	</div>
</div>
</body>
</html>
