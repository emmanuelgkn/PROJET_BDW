<?php
$nomM = get_nomMembre();
$message = "";
$estmodif =false;
$ajoute = false;
if(isset($_POST['boutonAfficher'])) {
    $id = $_POST['nomMembre'];
    $_SESSION['idmem'] = $_POST['nomMembre'];
	$result = executer_une_requete("SELECT NomM as nom, PrenomM as prenom, date_naiss FROM p2100037.Membre_fed WHERE idMem = $id ");

    if($result == null)
    {
        $message_requete = "Commande invalide hélas...";
    }
    else{
        if(count($result) == 0)
        {
            $message_requete = "Il n'ya aucun resultat déso...";
        }
    }
}

if(isset($_POST['boutonModifier']))
{
    $id = $_SESSION['idmem'];
    $estmodif = modifier_membre($_POST['NomM'],$_POST['PrenomM'],$_POST['date'],$id);

}

if(isset($_POST['ajoute']))
{   
    if($_POST['Nom'] != " " && $_POST['Prenom'] !=  "" && $_POST['datee'] != " " ){
        $ajoute = ajouter_membre($_POST['Nom'],$_POST['Prenom'],$_POST['datee']);}
}

?>

