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
				<h2 class="col-12"><?php echo $codEtapa?></h2>
				<div class="col-6">
					<h3>QUITAR ETAPA PADRE</h3>
					<?php
					if(isset($this->etapasPadre))
						foreach($this->etapasPadre as $indice => $valor)
							echo '<div> '.$valor.'<a href="'.base_url().'C_GestionEVG/quitarEtapaPadre/'.$idEtapa.'/'.$indice.'"><button  class="btn btn-outline-danger">Quitar </button></a></div>';
					else
						echo 'No hay etapas padre';
					?>
				</div>
				<div class="col-6">
					<h3>AÑADIR ETAPA PADRE</h3>
					<?php
					if(isset($this->etapasNoPadre))
						foreach($this->etapasNoPadre as $indice => $valor)
							echo '<div> '.$valor.'<a href="'.base_url().'C_GestionEVG/anadirEtapaPadre/'.$idEtapa.'/'.$indice.'"><button class="btn btn-outline-success">Añadir </button></a></div>';
					else
						echo 'No hay etapas padre disponibles';
					?>
				</div>
			</div>
			<a href="<?php echo base_url()?>C_GestionEVG/verEtapas">Volver</a>
		</div>
	</div>
</div>
</body>
</html>
