<?php
include('application/views/Plantilla/header.php');
?>

<html>
<head>
	<title>Aplicaciones Disponibles</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<header class="col-12">
			<h2>Aplicaciones disponibles</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<div class="col-12" id="gridAplicaciones">
			<?php
				if(empty($this->aplicaciones))
					echo 'Aún no tienes aplicaciones disponibles';
				else
					foreach($this->aplicaciones as $valor){
						echo '<a class="aplicacion" href="'.$valor['url'].'">'.$valor['nombre'];
						if(isset($valor['icono']))
							echo '<img id="iconoApp" src="../uploads/iconos/'.$valor['icono'].'"/>';
						echo '</a>';
					}
			?>
			<?php echo "<br/><br/><br/><a href='".base_url()."Auth/logout'>Cerrar sesión</a>";?>
		</div>
	</div>
</body>
</html>
