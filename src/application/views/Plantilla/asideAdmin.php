<aside>
	<div class="wrapper">
		<nav id="sidebar" class="active">
			<div class="sidebar-header">
					<?php
						$name = $this -> session -> userdata('name');
						echo "<h4>".$name."</h4>";
					?>
			</div>

			<ul class="list-unstyled components">
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerApps'>Aplicaciones</a>"; ?>
				</li>
				<li>
					<?php echo "<a href='".base_url()."C_GestionEVG/VerPerfiles'>Perfiles</a>"; ?>
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
