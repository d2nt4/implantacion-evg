<?php
	include('application/views/Plantilla/header.php');
?>

<html>
	<head>
		<title>EVG - Aplicaciones</title>
	</head>
	<body>
		<div id="principal" class="container-fluid">
			<div class="row">
				<header class="col-12">
					<div class="col-6">
						<?php echo '<a href="'.base_url().'C_GestionEVG/"><img id="logo-evg" src="'.base_url().'uploads/iconos/escudo-evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>APLICACIONES</h3>
					</div>
					<div class="col-6">
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div id="principal" class="container-fluid">
				<div id="gridAplicaciones" class="row row-cols-4">
					<?php
						if(empty($this->aplicaciones))
							echo 'Aún no tiene aplicaciones disponibles';
						else
							foreach($this->aplicaciones as $valor)
							{
								echo
								'
									<div class="col box one">
										<a href="'.$valor['url'].'">
											<h1><b>'.$valor['nombre'].'</b></h1>';
									if(isset($valor["icono"]))
										echo
										'
											<div class="poster p1">
												<img src="uploads/iconos/'.$valor['icono'].'" id="icono-app"/>
											</div>
										</a>
									</div>							
								';
							}
					?>
				</div>

			</div>
		</div>
	</body>
</html>
