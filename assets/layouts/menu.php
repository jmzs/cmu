<div class="left-side-wrapper">
	<div class="left-side sticky-left-side">
		<div class="left-side-inner">
			<ul class="nav nav-pills nav-stacked custom-nav menu_modulos">
				<li class="nav-header">Soft Tutoria</li>
				<?php
					foreach ($modulos as $key => $value) {
						echo '<li class="menu-list "><a href="#"><i class="'.$value["modulo_icono"].'"></i> <span>'.$value["modulo_nombre"].'</span> <i class="ion ion-ios7-arrow-down pull-right"></i></a>';
							echo '<ul class="sub-menu-list">';
								foreach ($value["hijos"] as $hijo) {
									echo '<li><a href="'.$hijo["modulo_url"].'">'.$hijo["modulo_nombre"].'</a></li>';
								}
							echo '</ul>';
						echo '</li>';
					}
				?>
			</ul>
		</div>
	</div>
</div>
