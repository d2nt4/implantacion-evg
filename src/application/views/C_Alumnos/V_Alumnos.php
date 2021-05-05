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
					<?php
						echo "<a href='".base_url()."C_GestionEVG/importarAlumnosForm' tabindex='-1'><button>Importar</button></a><a href='".base_url()."C_GestionEVG/anadirAlumnoForm' tabindex='-1'><button id='anadir'>Nuevo alumno</button></a><button id='info' onclick='info(\"Para acceder a los alumnos de una sección, elige la etapa a la que pertenece y luego la sección.\")'>información</button><br/><br/><br/>";
						foreach($this -> listaEtapas as $indice => $valor)
							echo '<a href="'.base_url().'C_GestionEVG/verSeccionesEtapa/'.$indice.'" tabindex="-1"><button>'.$valor.'</button></a>';
						echo '<div id="cuadroInfo"></div>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
