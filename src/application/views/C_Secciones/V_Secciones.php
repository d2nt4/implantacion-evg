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
			<h2>SECCIONES</h2>
			<?php
			echo "<a href='".base_url()."C_GestionEVG/importarSeccionesForm' tabindex='-1'><button>Importar</button></a><a href='".base_url()."C_GestionEVG/anadirSeccionForm' tabindex='-1'><button id='anadir'>Nueva sección</button></a><table>";
			foreach($this->listaSecciones as $indice => $valor)
				echo '<tr><td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/asignarTutorForm/'.$indice.'" tabindex=\'-1\'><button>Asignar/Quitar tutor</button></a><a href="'.base_url().'C_GestionEVG/modificarSeccionForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar la sección: '.$valor.'?\',\''.base_url().'C_GestionEVG/borrarSeccion/'.$indice.'\')">Borrar</button></td></tr>';
			echo '</table>';
			?>
		</div>
	</div>
</div>
</body>
</html>
