<div class="vuee">
    <div>
        <div class = "titre_form_fed">
            <h2>Choisisez votre Nom</h2>
        </div> 
        <form class="bloc_commandes" method="post" action="#">	

            <label for="typeVueTable">Nom membre</label>		

            <select name="typeVue" id="typeVue">
                <?php foreach($nomAdh as $n) { ?>
                    <option value="<?= $n['NomM'] ?>"><?= $n['NomM']. " " .$n['PrenomM'] ?></option>
                <?php } ?>
            </select>

             <input type="submit" name="boutonAfficher" value="Accéder"/>
        </form>
    </div>
</div>