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
		<?php echo "<button onclick='".base_url()."Auth/logout'><i class=\"fa fa-sign-out-alt\"></i></button>";?>
	</div>
	<div class="row" id="contenedor">
		<div class="col-12" id="gridAplicaciones">
			<?php
				if(empty($this->aplicaciones))
					echo 'Aún no tienes aplicaciones disponibles';
				else
					foreach($this->aplicaciones as $valor)
					{
						echo '<a class="aplicacion" href="'.$valor['url'].'">'.$valor['nombre'];
						if(isset($valor['icono']))
							echo '<img id="iconoApp" src="uploads/iconos/'.$valor['icono'].'"/>';
						echo '</a>';
					}
			?>
		</div>
	</div>
</body>
</html>
