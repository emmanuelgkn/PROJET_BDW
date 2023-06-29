<div class="tabfedivprince">
    <div class = "titre_form_membres">
        <h1>GESTIONNAIRE DE MEMBRES</h1>
    </div>
    <div class = "instruction_membres">
        <h3>choisisez le membre que vous voulez visualiser</h3>
    </div>
    <div>
        <form name = 'form1' class="bloc_commandes" method="post" action="#">	

        <label>Nom</label>		

        <select name="nomMembre" id="typeVue">
            <?php foreach($nomM as $n) { ?>
                <option value="<?= $n['idMem'] ?>"><?= $n['NomM'] . " " . $n['PrenomM'] ?></option>
            <?php } ?>
        </select>

        <input type="submit" name="boutonAfficher" value="Afficher"/>
        </form>
    </div>
    <div class = "div_boutton_ajouter">
        <h1>ou</h1>
       <form method = "post" >
        <input type = "submit" id="boutton_ajouter" name = "ajouter" value = "Ajoutez un membre">
       </form> 
       
    </div>
    <div class = "div_modif">
        <?php if(isset($_POST['ajouter'])) {?>
            <h2>Veuillez ajouter un membre</h2>
            <form method = 'post'>
            <label>Nom</label></br>		
            <input type = "text" id="nomme" name="Nom"/></br></br>
            <label>Prenom</label></br>
            <input type = "text" id="prenomme" name="Prenom"/></br></br>
            <label>Annee de naissance</label></br>
            <input type = "date" id="date" name="datee"/></br></br>
            <input type = "submit" name = "ajoute" value = "Ajouter">
            </form>
        <?php  }?>
        <?php if($ajoute) {?>
            <p class="notification"> <?php $_POST['Prenom'] ?> a été ajouté avec succès !</p>
        
        <?php }?> 
    </div>
    <div class = "table_membre">
    <?php if( isset($result) || $message != null) {
            if( is_array($result) ) { 
        ?>

        <table class="table_resultat">
        <thead>
                <tr>
                    <?php
                    //var_dump($result);
                        foreach($result['schema'] as $att) {  // pour parcourir les attributs
                        echo '<th>';
                        echo $att['nom'];
                        echo '</th>';
                        }
                    ?>	
            </tr>	
        </thead>
        <tbody>
        <?php
                foreach($result['instances'] as $row) {  // pour parcourir les n-uplets
        
                echo '<tr>';
                foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets
        
                    echo '<td>'. $valeur . '</td>';
                }
                echo '</tr>';
                }
        ?>
        </tbody>
    </table>
    <form method="post">
    <input type="submit" id = "modifier" name="modif" value="Modifier"/>
    </form>
        <?php }else{ ?>

            <p class="notification"><?= $message ?></p>	

        <?php } 

        }?>
    </div>
        
    <div class = "div_modif">
         <?php if(isset($_POST['modif']) ){
        ?>
        <h2>Faites vos modifications ici</h2>
        <form method="post" action="#">	

        <label>Nom</label></br>		
        <input type="text" id="nomme" name="NomM"/></br></br>
        <label>Prenom</label></br>	
        <input type = "text" id="prenomme" name="PrenomM" /></br></br>
        <label>Annee de naissance</label></br>
        <input type = "date" id="date" name="date"/></br></br>

        <input type="submit" name="boutonModifier" value="Valider"/>
        <?php } ?>
        <?php if($estmodif) {?>
            <p class="notification">Modification effectué avec succès !</p>
        <?php } ?> 
        
    </div>
</div>