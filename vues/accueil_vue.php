<main class = "panneau">
    <div class = "titre_descr_accueil">
        <h1>Description du Site</h1>
    </div>
    <div class = "descr_acceuil">
        <p>
            Ce site qui permet de gérer un ensemble d’école de danses et de compétitions
            organisées par des fédérations. Dans ce site vous pourrez gérer différentes
            choses comme les inscription, l'ajout et le retrait de différents membres et
            Plus encore.
        </p>
    </div>
    <div class = "titre_stats">
        <h1>Quelques Statistiques</h1>
	</div>
    <div classe = "stats">
        <h3>Nombre de federation, de Comités Regionales et comités départementales</h3>
		<?php if( $message != "" ) { ?>

		<p class="notification"><?= $message ?></p>

		<?php }else{?>

		<table class="table_resultat">
			<thead>
				<tr>
					<?php
						//var_dump($statun);
						foreach($statun['schema'] as $att) {  // pour parcourir les attributs
		
							echo '<th>';
							echo $att['nom'];
							echo '</th>';
		
						}
					?>	
				</tr>	
			</thead>
			<tbody>

					<?php
					foreach($statun['instances'] as $row) {  // pour parcourir les n-uplets
		
							echo '<tr>';
							foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets
		
								echo '<td>'. $valeur . '</td>';
						}
						echo '</tr>';
					}
					?>
					<?php }?>
			</tbody>
		</table>
		<h3>Le nombre d’écoles par code de département français</h3>
		<?php if( $message != "" ) { ?>

			<p class="notification"><?= $message ?></p>

		<?php }else{?>

		<table class="table_resultat">
			<thead>
				<tr>
					<?php
						//var_dump($statun);
						foreach($statdeux['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';

						}
					?>	
				</tr>	
			</thead>
			<tbody>

					<?php
					foreach($statdeux['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>'. $valeur . '</td>';
						}
						echo '</tr>';
					}
					?>
					<?php }?>
			</tbody>
		</table>
		<h3>La liste des comités régionaux de la Fédération Française de Danse</h3>
		<?php if( $message != "" ) { ?>

			<p class="notification"><?= $message ?></p>

		<?php }else{?>

		<table class="table_resultat">
			<thead>
				<tr>
					<?php
						//var_dump($statun);
						foreach($statrois['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';

						}
					?>	
				</tr>	
			</thead>
			<tbody>

					<?php
					foreach($statrois['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>'. $valeur . '</td>';
						}
						echo '</tr>';
					}
					?>
					<?php }?>
			</tbody>
		</table>
		<h3>le top 5 des écoles françaises de danse</h3>
		<?php if( $message != "" ) { ?>

			<p class="notification"><?= $message ?></p>

		<?php }else{?>

		<table class="table_resultat">
			<thead>
				<tr>
					<?php
						//var_dump($statun);
						foreach($statquatre['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';

						}
					?>	
				</tr>	
			</thead>
			<tbody>

					<?php
					foreach($statquatre['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>'. $valeur . '</td>';
						}
						echo '</tr>';
					}
					?>
					<?php }?>
			</tbody>
		</table>

	</div>

</main>