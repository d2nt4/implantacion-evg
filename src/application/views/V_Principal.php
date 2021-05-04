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
			<h2>ADMINISTRACIÓN EVG</h2>
		</header>
	</div>
	<div class="row" id="contenedor">
		<?php include('application/views/Plantilla/asideGestor.php') ?>
		<div class="col-9" >
			<?php echo $_SESSION['email'];
				echo "<a href='".base_url()."Auth/logout'>Cerrar sesión</a><br/>";
			?>
			</div>
		</div>
	</body>
</html>
