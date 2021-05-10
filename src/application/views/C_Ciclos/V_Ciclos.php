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
					<h2>CICLOS</h2>
					<?php
					echo "<a href='".base_url()."C_GestionEVG/anadirCicloForm' tabindex='-1'><button id='anadir'>Nuevo ciclo</button></a><table>";
					foreach($this->listaCiclos as $indice => $valor)
						echo '<tr><td><p id="valor"> '.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/cursosCiclo/'.$indice.'" tabindex=\'-1\'><button>Añadir/Quitar cursos</button></a><a href="'.base_url().'C_GestionEVG/modificarCicloForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el ciclo: <b>'.$valor.'</b>?\',\''.base_url().'C_GestionEVG/borrarCiclo/'.$indice.'\', \'Eliminar Ciclo\', \'Cancelar\', \'Eliminar\')" data-toggle="modal" data-target="#myModal">Borrar</button></td></tr>';
					echo '</table>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
