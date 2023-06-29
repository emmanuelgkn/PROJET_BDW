<div class="panneau_details"> <!-- Second bloc permettant l'affichage du détail d'une table -->

<h2>Identification</h2> 


<form class="bloc_commandes" method="post" action="#">	
    <label for="typeVueTable">Responsable école</label>		
    <select name="fondateurs" id="fondateurs">
        <!-- Parcourir et afficher tous les noms -->
        <?php foreach($responsables as $t) { ?>
            <option value="<?= $t['fondateurs'] ?>" <?php if(isset($_POST['fondateurs']) && $_POST['fondateurs'] == $t['fondateurs']) { echo 'selected'; } ?>><?= $t['fondateurs'] ?></option>
        <?php } ?>
    </select>
    <!-- Affichage button submit -->
    <input type="submit" name="boutonAfficher" value="Afficher"/>
</form>

<!-- Affichage nom École -->

        <table class="table_resultat_fed">

                <thead>
                    <tr>
                    <?php
                        if(isset($nomEcole)){
                            echo '<th>';
                            echo "Nom de l'école" . "<br>";
                            echo '</th>';
                        }
                    ?>	
                    </tr>	
                </thead>

               <tbody>
                    <tr>
                         <?php
                              if( isset($nomEcole) ){
                                echo '<tr>';
                                echo '<td>';
                                echo $nomEcole;
                                echo '</td>';
                                echo "<br>";
                                echo '</tr>';
                            }
                         ?>	
                    </tr>	
                </tbody>
        </table>

<!-- Affichage Adresse École -->
    <table class="table_resultat_fed">

    <thead>
        <tr>
        <?php
            if(isset($adresse_ecole)){
                echo '<th>';
                echo "Adresse de l'école" . "<br>";
                echo '</th>';
            }
        ?>	
        </tr>	
    </thead>

   <tbody>
        <tr>
             <?php
                  if( isset($adresse_ecole) ){
                    echo '<tr>';
                    echo '<td>';
                    foreach($adresse_ecole as $row){
                        echo "Adresse de l'école: " . $row['numVoie'] . " " . $row['rue'] . " " . $row['code_postal'] . " " . $row['ville'] . " " . $row['pays'] . "<br>";
                    }
                    echo '</td>';
                    echo "<br>";
                    echo '</tr>';
                }
             ?>	
        </tr>	
    </tbody>
</table>



<!-- Affichage Liste Employés -->

<table class="table_resultat_fed">

<thead>
    <tr>
    <?php
        if(isset($liste_employes)){
            echo '<th>';
            echo "Liste d'employés de l'école" . "<br>";
            echo '</th>';
        }
    ?>	
    </tr>	
</thead>

<tbody>
    <tr>
         <?php
              if( isset($liste_employes) ){

                echo '<tr>';
                echo '<td>';
                echo '<ul>';
                foreach($liste_employes as $row){
                    echo '<li>';
                    echo $row['nomEmp'] . " " . $row['prenomEmp'];
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

<!-- Affichage Nombre Adhérents -->

<table class="table_resultat_fed">

<thead>
    <tr>
    <?php
        if(isset($nombre_adherents)){
            echo '<th>';
            echo "Nombre d'adhérents de l'école pour l'anée en cours" . "<br>";
            echo '</th>';
        }
    ?>	
    </tr>	
</thead>

<tbody>
    <tr>
         <?php
              if( isset($nombre_adherents) ){
                echo '<tr>';
                echo '<td>';
                echo $nombre_adherents;
                echo '</td>';
                echo "<br>";
                echo '</tr>';
            }
         ?>	
    </tr>	
</tbody>
</table>

<!-- Affichage Liste Cours Proposés -->

<table class="table_resultat_fed">

<thead>
    <tr>
    <?php
        if(isset($liste_cours_proposes)){
            echo '<th>';
            echo "Liste de cours proposés par l'école" . "<br>";
            echo '</th>';
        }
    ?>	
    </tr>	
</thead>

<tbody>
    <tr>
         <?php
              if( isset($liste_cours_proposes) ){
                echo '<tr>';
                echo '<td>';
                echo '<ul>';
                foreach($liste_cours_proposes as $row){
                    echo '<li>';
                    echo $row['Libellé'];
                    echo '</li>';
                }
                echo '</ul>';
                echo '</td>';
                echo "<br>";
                echo '</tr>';
            }
         ?>	
    </tr>	
</tbody>
</table>




    <?php if(isset($_POST['boutonAfficher'])){
        
    ?>
        <h2>Modification de l'école</h2> 
        <form class="bloc_commandes" method="post" action="#">	

            <label for="typeVueTable">Changer nom de l'école</label>		
            <input type ="text" name="nomEcoleModif" id="nomEcoleModif">
            
            <br>
            <br>

            <label for="typeVueTable">Changer responsable de  l'école</label>		
            <input type ="text" name="fondateursModif" id="fondateursModif">


            <br>
            <br>

            <label for="typeVueTable">Changer le num voie de l'école</label>		
            <input type ="text" name="numVoieModif" id="numVoieModif">


            <br>
            <br>

            <label for="typeVueTable">Changer la rue de l'école</label>		
            <input type ="text" name="rueModif" id="rueModif">


            <br>
            <br>

            <label for="typeVueTable">Changer le code postal de l'école</label>		
            <input type ="text" name="code_postalModif" id="code_postalModif">


            <br>
            <br>

            <label for="typeVueTable">Changer la ville de l'école</label>		
            <input type ="text" name="villeModif" id="villeModif">
            <!-- Affichage button submit -->

            <br>
            <br>

            <input type="submit" name="boutonModifier" value="Modifier"/>

        </form>

        <?php
         }
        ?>

        <div class = "fonct_fed">
        <h1>Les différentes fonctionnalités proposées</h1>
        <ul>
            <li><a class="ligita">Gestion des informations des comités</a></li>
            <li><a class="ligita">Gestion des employés</a></li>
            <li><a class="ligita">Gestion des adhérents</a></li>
            <li><a class="ligita">Gestion des cours</a></li>
            <li><a class="ligita" href="index.php?page=inscriptions">Gestion des inscriptions de l'école</a></li>
        </ul>
   </div>



                    
                