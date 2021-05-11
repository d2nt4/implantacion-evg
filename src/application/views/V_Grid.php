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
			<div class="header-div"><h3>Escuela Virgen de Guadalupe - Aplicaciones</h3></div>
			<div class="header-div">
				<?php
					$picture = $this -> session -> userdata('profile_pic');
					echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
				?>
				<?php echo '<a href="'.base_url().'Auth/logout" class="logout"><i class="fa fa-sign-out-alt"></i></a>';?>
			</div>
		</header>
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
