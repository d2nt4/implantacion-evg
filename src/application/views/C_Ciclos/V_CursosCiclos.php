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
			<div class="row">
				<h2 class="col-12"><?php echo $codCiclo?></h2>
				<div class="col-6">
					<h3>QUITAR CURSO DEL CICLO</h3>
					<?php
					if(isset($this->ciclosCurso))
						foreach($this->ciclosCurso as $indice => $valor)
							echo '<div> <p id="valor">'.$valor.'</p><a href="'.base_url().'C_GestionEVG/quitarCursoCiclo/'.$idCiclo.'/'.$indice.'"><button  class="btn btn-outline-danger">Quitar </button></a></div>';
					else
						echo 'No hay cursos de este ciclo';
					?>
				</div>
				<div class="col-6">
					<h3>AÑADIR CURSO AL CICLO</h3>
					<?php
					if(isset($this->cursosNoCiclo))
						foreach($this->cursosNoCiclo as $indice => $valor)
							echo '<div> '.$valor.'<a href="'.base_url().'C_GestionEVG/anadirCursoCiclo/'.$idCiclo.'/'.$indice.'"><button class="btn btn-outline-success">Añadir </button></a></div>';
					else
						echo 'No hay cursos disponibles para añadir';
					?>
				</div>
			</div>
			<a href="<?php echo base_url()?>C_GestionEVG/verCiclos">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
