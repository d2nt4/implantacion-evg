<?php
	include('application/views/Plantilla/header.php');
?>

<html>
	<head>
		<title>Administración EVG</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<header class="col-12">
					<h2>ADMINISTRACIÓN EVG</h2>
				</header>
			</div>
			<div class="row" id="contenedor">
				<?php include('application/views/Plantilla/asideAdmin.php') ?>
				<div class="col-9" >
					<div class="row">
						<h2 class="col-12"><?php echo $nombreApp?></h2>
						<div class="col-6">
							<h3>QUITAR ACCESO AL PERFIL</h3>
							<?php
							if(isset($this->perfilesAplicacion))
								foreach($this->perfilesAplicacion as $indice => $valor)
									echo '<div> <p id="valor">'.$valor.'</p><a href="'.base_url().'C_GestionEVG/quitarPerfilAplicacion/'.$idAplicacion.'/'.$indice.'"><button  class="btn btn-outline-danger">Quitar </button></a></div>';
							else
								echo 'No hay perfiles con acceso a la aplicación';
							?>
						</div>
						<div class="col-6">
							<h3>AÑADIR ACCESO AL PERFIL</h3>
							<?php
							if(isset($this->perfilesNoAplicacion))
								foreach($this->perfilesNoAplicacion as $indice => $valor)
									echo '<div> '.$valor.'<a ondblclick="location.href=\''.base_url().'C_GestionEVG/perfilesAplicacion/'.$idAplicacion.'\'" href="'.base_url().'C_GestionEVG/anadirPerfilAplicacion/'.$idAplicacion.'/'.$indice.'"><button class="btn btn-outline-success">Añadir </button></a></div>';
							else
								echo 'No hay perfiles disponibles para añadir';
							?>
						</div>
					</div>
					<a href="<?php echo base_url()?>C_GestionEVG/verApps">Volver</a>
				</div>
			</div>
		</div>
	</body>
</html>
