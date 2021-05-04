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
			<h2><?php echo'Sección: '.$codSeccion?></h2>
			<?php
			if(empty($this->listaAlumnos))
				echo 'No hay alumnos en esta sección';
			else {
				echo '<table>';
				foreach ($this->listaAlumnos as $indice => $valor)
					echo '<tr><td><p id="valor">' . $valor . '</p></td><td><a href="' . base_url() . 'C_GestionEVG/modificarAlumnoForm/' . $indice . '/' . $idEtapa . '" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el alumno: ' . $valor . '?\',\'' . base_url() . 'C_GestionEVG/borrarAlumno/' . $indice . '\')">Borrar</button></td></tr>';
				echo '</table>';
			}
			echo '<br/><br/><a href="' . base_url() . 'C_GestionEVG/verSeccionesEtapa/' . $idEtapa . '">Volver</a>';
			?>
		</div>
	</div>
</div>
</body>
</html>
