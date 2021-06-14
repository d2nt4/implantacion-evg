<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Sesión Usuario</title>
	</head>
	<body>
		<div id="principal" class="container-fluid animate__animated animate__fadeIn">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main"><img id="logo-evg" src="'.base_url().'uploads/iconos/evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>USUARIO</h3>
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "main'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Aplicaciones\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div id="principal" class="container-fluid animate__animated animate__slideInLeft">
				<?php
					echo "<h2>Datos Usuario:</h2></br>";
					echo "<h3>ID -> ".$this -> session -> userdata('id')."</h3></br>";
					echo "<h3>Nombre -> ".$this -> session -> userdata('username')."</h3>";
				?>
			</div>
		</div>
	</body>
</html>
