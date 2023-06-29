<div class="panneau_details"> <!-- Second bloc permettant l'affichage du détail d'une table -->

<h2>Détails des inscriptions</h2> 


<form class="bloc_commandes" method="post" action="#">	

    <br>

    <label for="typeVueTable">Nom Adhérent</label>		
    <select name="nomAdh" id="nomAdh">

        <!-- Parcourir et afficher tous les noms -->
        <?php foreach($nomAdh as $t) { ?>
            <option value="<?= $t['nomAdh'] ?>" <?php if(isset($_POST['nomAdh']) && $_POST['nomAdh'] == $t['nomAdh']) echo 'selected'; ?>><?= $t['nomAdh'] ?></option>
        <?php } ?>

    </select>

    <br>
    <br>

    <label for="typeVueTable">Prénom Adhérent</label>		
    <select name="prenomAdh" id="prenomAdh">

        <!-- Parcourir et afficher tous les prénoms -->
        <?php foreach($prenomAdh as $t) { ?>
            <option value="<?= $t['prenomAdh'] ?>" <?php if(isset($_POST['prenomAdh']) && $_POST['prenomAdh'] == $t['prenomAdh']) echo 'selected'; ?>><?= $t['prenomAdh'] ?></option>
        <?php } ?>

    </select>

    <br>
    <br>
    
    <!-- Affichage button submit -->
    <input type="submit" name="boutonAfficher" value="Afficher"/>

    <br>
</form>

<!-- Affichage cours Adhérent -->

<table class="table_resultat_fed">

                <thead>
                    <tr>
                    <?php
                        if(isset($cours)){
                            echo '<th>';
                            echo "Cours de l'adhérent" . "<br>";
                            echo '</th>';
                        }
                    ?>	
                    </tr>	
                </thead>

               <tbody>
                    <tr>
                         <?php
                              if( isset($cours) ){
                                echo '<tr>';
                                echo '<td>';
                                echo '<ul>';
                                foreach($cours as $row){
                                    echo '<li>';
                                    echo $row['libel_cours'];
                                    echo '</li>';
                                }
                                echo '</ul>'; // Fin de la lista
                                echo '</td>';
                                echo "<br>";
                                echo '</tr>';
                            }
                         ?>	
                    </tr>	
                </tbody>
</table>



<?php
    if(isset($cours)){
        ?>

        <!-- Formulaire ajouter cours -->
        <h2>Ajouter cours</h2> 
        <form class="bloc_commandes" method="post" action="#">	

        <br>

        <label for="typeVueTable">Choix possibles de cours</label>		
        <select name="libel_cours_ecole" id="libel_cours_ecole">

            <!-- Parcourir et afficher tous les noms -->
            <?php foreach($libel_cours_ecole as $t) { ?>
                <option value="<?= $t['libel_cours_ecole'] ?>" 
                <?php if(isset($_POST['libel_cours_ecole']) 
                && $_POST['libel_cours_ecole'] == $t['libel_cours_ecole']) echo 'selected'; ?>>
                <?= $t['libel_cours_ecole'] ?></option>
            <?php } ?>

        </select>

        <br>
        <br>

        <!-- Affichage button submit -->
        <input type="submit" name="boutonAjouter" value="Ajouter"/>

        <br>
        </form>
        
<!-- Formulaire effacer cours -->
        <h2>Effacer cours</h2> 
        <form class="bloc_commandes" method="post" action="#">	

        <br>

        <label for="typeVueTable">Choix possibles de cours</label>		
        <select name="libel_cours" id="libel_cours">

            <!-- Parcourir et afficher tous les noms -->
            <?php foreach($libel_cours as $t) { ?>
                <option value="<?= $t['libel_cours'] ?>" 
                <?php if(isset($_POST['libel_cours']) 
                && $_POST['libel_cours'] == $t['libel_cours']) echo 'selected'; ?>>
                <?= $t['libel_cours'] ?></option>
            <?php } ?>

        </select>

        <br>
        <br>

        <!-- Affichage button submit -->
        <input type="submit" name="boutonEffacer" value="Effacer"/>

        <br>
        </form>

    <?php

    }
?>







                    
                