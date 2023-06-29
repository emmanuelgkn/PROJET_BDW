<?php
$libelle_affiche = null;
$CodeComp = null;
$Libellé = get_competitions();

if(isset($_POST['boutonAfficher'])) {

	$libelle_affiche = mysqli_real_escape_string($connexion, trim($_POST['Libellé']));
    $TabCodeComp = get_codeCompetitions($libelle_affiche);
    $CodeComp = $TabCodeComp['CodeComp'];
    $Editions = get_liste_edition($CodeComp);

    $_SESSION['Libellé'] = $libelle_affiche;
    $_SESSION['CodeComp'] = $CodeComp;
}

if(isset($_POST['boutonModifier'])){

    $Libellé = $_SESSION['Libellé'];
    $CodeComp = $_SESSION['CodeComp'];
    $LibelléModif = mysqli_real_escape_string($connexion, trim($_POST['nomCompModif']));
    $CodeCompModif = mysqli_real_escape_string($connexion, trim($_POST['CodeCompModif']));
    $NiveauModif = mysqli_real_escape_string($connexion, trim($_POST['NiveauCompModif']));

    $modificationsCompet = modifier_competition($LibelléModif, $CodeCompModif, $NiveauModif, $Libellé, $CodeComp);
}

if(isset($_POST['boutonAjouter'])){

    $LibelléAjouter = mysqli_real_escape_string($connexion, trim($_POST['nomCompAjouter']));
    $CodeCompAjouter = mysqli_real_escape_string($connexion, trim($_POST['CodeCompAjouter']));
    $NiveauAjouter = mysqli_real_escape_string($connexion, trim($_POST['NiveauCompAjouter']));

    $ajouterCompet = ajouter_competition($LibelléAjouter, $CodeCompAjouter, $NiveauAjouter);
}

if(isset($_POST['boutonajedition'])){
    $ajoutedition = ajouter_edition($_SESSION['CodeComp'],$_POST['anneedition'],$_POST['villeedition'],$_POST['structedition']);
}

if (isset($_POST['boutonsupredition'])){
    $supprimeredition = supprimer_edition($_POST['listeedition']);
}

if(isset($_POST['boutonsuprcompet'])){
    $supprimercomtpetition = supprimer_competition($_POST['listecompetition']);
}

?>