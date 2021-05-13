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
			<div class="header-div"><h3>Administración Escuela Virgen de Guadalupe</h3></div>
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
		<?php include('application/views/Plantilla/asideGestor.php')?>
	</div>
</body>
</html>
