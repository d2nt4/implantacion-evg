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
					<h2>CURSOS</h2>
					<?php
					echo "<a href='".base_url()."C_GestionEVG/importarCursosForm' tabindex='-1'><button>Importar cursos</button></a><a href='".base_url()."C_GestionEVG/anadirCursoForm' tabindex='-1'><button id='anadir'>Nuevo curso</button></a><table>";
					foreach($this->listaCursos as $indice => $valor)
						echo '<tr><td><p id="valor"> '.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/asignarEtapaCursoForm/'.$indice.'" tabindex=\'-1\'><button>Asignar etapa</button></a><a href="'.base_url().'C_GestionEVG/modificarCursoForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el curso: <b>'.$valor.'</b>?\',\''.base_url().'C_GestionEVG/borrarCurso/'.$indice.'\', \'Eliminar Curso\', \'Cancelar\', \'Eliminar\')" data-toggle="modal" data-target="#myModal">Borrar</button></td></tr>';
					echo '</table>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
