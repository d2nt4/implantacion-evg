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
			<h2>ETAPAS</h2>
			<?php
			echo "<a href='".base_url()."C_GestionEVG/anadirEtapaForm'><button id='anadir'>Nueva etapa</button></a><table>";
			foreach($this->listaEtapas as $indice => $valor)
				echo '<tr><td><p id="valor">'.$valor.'</p></td><td><a href="'.base_url().'C_GestionEVG/etapaPadre/'.$indice.'" tabindex=\'-1\'><button>Añadir/Quitar etapa padre</button></a><a href="'.base_url().'C_GestionEVG/modificarEtapaForm/'.$indice.'" tabindex=\'-1\'><button>Modificar</button></a><button onclick="confirmar(\'¿Seguro que quieres borrar la etapa: '.$valor.'?\',\''.base_url().'C_GestionEVG/borrarEtapa/'.$indice.'\')">Borrar</button></td></tr>';
			echo '</table>';
			?>
		</div>
	</div>
</div>
</body>
	</html>
