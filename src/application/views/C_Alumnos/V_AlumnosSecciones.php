<?php
	include('application/views/Plantilla/header.php');
?>


<html>
	<head>
		<title>Gestión EVG</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<h2>GESTIÓN EVG</h2>
				</header>
			</div>
			<div class="row" id="contenedor">
				<?php include('application/views/Plantilla/asideGestor.php')?>
				<div class="col-9" >
					<h2><?php echo'Etapa: '.$codEtapa?></h2>
					<?php
						if(empty($this->listaSecciones))
							echo 'No hay secciones que formen parte de esta etapa';
						else
							foreach($this->listaSecciones as $indice => $valor)
								echo '<a href="'.base_url().'C_GestionEVG/verAlumnosSeccion/'.$indice.'/'.$idEtapa.'"  tabindex=\'-1\'><button>'.$valor.'</button></a>';
						echo '</br></br><a href="'.base_url().'C_GestionEVG/verAlumnos">Volver</a>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
