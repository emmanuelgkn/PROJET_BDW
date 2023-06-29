<div class="panneau_details"> <!-- Second bloc permettant l'affichage du détail d'une table -->

<h2>Gestion des compétitions</h2> 

<form class="bloc_commandes" method="post" action="#">	
    <label for="typeVueTable">Compétition</label>		
    <select name="Libellé" id="Libellé">
        <!-- Parcourir et afficher tous les noms -->
        <?php foreach($Libellé as $t) { ?>
            <option value="<?= $t['Libellé'] ?>" <?php if(isset($_POST['Libellé']) && $_POST['Libellé'] == $t['Libellé']) { echo 'selected'; } ?>><?= $t['Libellé'] ?></option>
        <?php } ?>
    </select>
    <!-- Affichage button submit -->
    <input type="submit" name="boutonAfficher" value="Afficher"/>
</form>

<?php 
    if(isset($_POST['boutonAfficher'])){       
?>
        <table class="table_resultat_fed">

            <thead>
            <tr>
            <?php
                if(isset($Editions)){
                    echo '<th>';
                    echo "Liste d'éditions" . "<br>";
                    echo '</th>';
            }
            ?>	
            </tr>	
            </thead>

        <tbody>
            <tr>
            <?php
                 if( isset($Editions) ){
                    echo '<tr>';
                    echo '<td>';
                    foreach($Editions as $row){
                        echo $row['Code'] . " " . $row['Code_Année'] . " " . $row['Ville_orga'] ." ". $row['NomStruct'] ."<br>";
                    }
                    echo '</td>';
                    echo "<br>";
                    echo '</tr>';
                 }
            ?>	
            </tr>	
        </tbody>
        </table>

        <h2>Modification de la compétition</h2> 
        <form class="bloc_commandes" method="post" action="#">	

            <label for="typeVueTable">Changer nom de la compétition</label>		
            <input type ="text" name="nomCompModif" id="nomCompModif">
            
            <br>
            <br>

            <label for="typeVueTable">Changer le code de la compétition</label>		
            <input type ="text" name="CodeCompModif" id="CodeCompModif">


            <br>
            <br>

            <label for="typeVueTable">Changer le niveau de la compétition</label>		
            <input type ="text" name="NiveauCompModif" id="NiveauCompModif">


            <br>
            <br>


            <input type="submit" name="boutonModifier" value="Modifier"/>

        </form>

        <h2>Ajouter une compétition</h2> 
        <form class="bloc_commandes" method="post" action="#">	

            <label for="typeVueTable">Nom de la compétition</label>		
            <input type ="text" name="nomCompAjouter" id="nomEcolenomCompAjouterModif">
            
            <br>
            <br>

            <label for="typeVueTable">Code de la compétition</label>		
            <input type ="text" name="CodeCompAjouter" id="CodeCompAjouter">


            <br>
            <br>

            <label for="typeVueTable">Niveau de la compétition</label>		
            <input type ="text" name="NiveauCompAjouter" id="NiveauCompAjouter">


            <br>
            <br>


            <input type="submit" name="boutonAjouter" value="Ajouter"/>

        </form>
        
        <h2>Ajouter une Edition</h2>
        <form class="bloc_commandes" method="post" action="#">
            <label for="typeVueTable">Année</label>
            <input type="text" name="anneedition"/>
            <br>
            <br>
            <label for="typeVueTable">Ville</label>
            <input type="text" name="villeedition"/>
            <br>
            <br>
            <label for="typeVueTable">Structure</label>
            <input type="text" name="structedition"/>
            <br>
            <br>
            <input type="submit" name="boutonajedition" value="Ajouter"/>
        </form>

        <h2>Supprimer une Edition</h2>
        <form class="bloc_commandes" method="post" action="#">
            <label for="typeVueTable">Editions</label>		
            <select name="listeedition">

                <?php foreach($Editions as $e) { ?>
                    <option value="<?= $e['idCompet'] ?>"><?= $e['Code'] . " " . $e['Code_Année'] . " " . $e['Ville_orga'] ?></option>
                <?php } ?>

            </select>
            <br>
            <br>
            <input type="submit" name="boutonsupredition" value="Supprimer"/>
        </form>

        <h2>Supprimer une competition</h2>
        <form action="#" method="post" class="bloc_commandes">
            <label for="typeVueTable">Compétition</label>
            <select name="listecompetition">

                <?php foreach($Libellé as $l) { ?>
                    <option value="<?= $l['Libellé'] ?>"><?= $l['Libellé'] ?></option>
                <?php } ?>

            </select>
            <input type="submit" name="boutonsuprcompet" value="Supprimer"/>

        </form>

<?php
    }
?>
</div>