<aside class="show">
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<?php
					$name = $this -> session -> userdata('name');
					echo "<h5 class='font-weight-bolder'>".$name."</h5>";
				?>
			</div>

			<ul class="list-unstyled components">
				<li>
					<?php echo "<a href='".base_url()."C_AdministracionEVG/VerApps'>Aplicaciones</a>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_AdministracionEVG/VerPerfiles'>Perfiles</a>"; ?>
				</li>
			</ul>

<!--			<ul class="list-unstyled CTAs">-->
<!--				<li>-->
<!--					<a href="#" class="download">Botón 1</a>-->
<!--				</li>-->
<!--				<li>-->
<!--					<a href="#" class="article">Botón 2</a>-->
<!--				</li>-->
<!--			</ul>-->
		</nav>
	</div>
</aside>
