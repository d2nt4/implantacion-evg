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
					<h2>FAMILIAS PROFESIONALES</h2>
					<?php
					echo "<a href='".base_url()."C_GestionEVG/anadirFamiliaForm' tabindex='-1'><button id='anadir'>Nueva familia profesional</button></a><table>";
					foreach($this->listaFamilias as $indice => $valor)
						echo '<tr><td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/modificarFamiliaForm/'.$indice.'" tabindex="-1"><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar la familia profesional: <b>'.$valor.'</b>?\',\''.base_url().'C_GestionEVG/borrarFamilia/'.$indice.'\', \'Eliminar Familia\', \'Cancelar\', \'Eliminar\')" data-toggle="modal" data-target="#myModal">Borrar</button></td></tr>';
					echo '</table>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
