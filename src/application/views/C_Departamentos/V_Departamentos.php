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
					<h2>DEPARTAMENTOS</h2>
					<?php
					echo "<a href='".base_url()."C_GestionEVG/anadirDepartamentoForm' tabindex='-1'><button id='anadir'>Nuevo departamento</button></a><table>";
					foreach($this->listaDepartamentos as $indice => $valor)
						echo '<tr><td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/modificarDepartamentoForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar el departamento: <b>'.$valor.'</b>?\',\''.base_url().'C_GestionEVG/borrarDepartamento/'.$indice.'\', \'Eliminar Departamento\', \'Cancelar\', \'Eliminar\')" data-toggle="modal" data-target="#myModal">Borrar</button></td></tr>';
					echo '</table>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
