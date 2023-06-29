<?php 

$idAdh = null;
$cours = null;
$cours_idCo = null;

$message_liste = "";
$message_details = "";

// Affichage nom adhérent
$nomAdh = get_nomAdherent();

if($nomAdh == null || count($nomAdh) == 0) {
	$message_liste = "Aucun nom n'a été trouvée dans la base de données !";
}

// Affichage prenom adhérent
$prenomAdh = get_prenomAdherent();

if($prenomAdh == null || count($prenomAdh) == 0) {
	$message_liste = "Aucun prénom n'a été trouvée dans la base de données !";
}

if(isset($_POST['boutonAfficher'])) {

	$nomAdhAffiche = mysqli_real_escape_string($connexion, trim($_POST['nomAdh']));
	$prenomAdhAffiche = mysqli_real_escape_string($connexion, trim($_POST['prenomAdh']));

	$tab_idAdherent = get_idAdh_by_nom_prenom($nomAdhAffiche, $prenomAdhAffiche);
	$idAdh = $tab_idAdherent['idA'];
	
	// Affichage tableau cours
    $cours = get_cours_by_adherent($idAdh);	
	
	//affichage liste deroulante cours d'une école
	$libel_cours_ecole = get_liste_cours_ecole($idAdh);

	//affichage liste deroulante cours d'un adhérent
	$libel_cours = get_cours_by_adherent($idAdh);

	$_SESSION['idAdh'] = $idAdh;
	
}


if(isset($_POST['boutonAjouter'])){
		
	$idAdh = $_SESSION['idAdh'];

	$libel_cours_affiche = mysqli_real_escape_string($connexion, trim($_POST['libel_cours_ecole']));
	$tab_cours_idCo = get_idCo_by_ecole($libel_cours_affiche, $idAdh);
	$cours_idCo = $tab_cours_idCo['cours_idCo'];

	$modificationCours = ajouter_cours($cours_idCo, $idAdh);
	/*
	if($modificationCours==true) {
		echo "<p class='notification'>" . "Modification effectué avec succès !" . "</p>";
	}
	*/
	
}



if(isset($_POST['boutonEffacer'])){

	//$cours_idCo = $_SESSION['cours_idCo'];
	$idAdh = $_SESSION['idAdh'];

	//echo "Preuve 2: <br> cours_idCo = " . $cours_idCo . "idAdh = " . $idAdh . "<br>"; 
	
	$libel_cours_affiche = mysqli_real_escape_string($connexion, trim($_POST['libel_cours']));
	$tab_cours_idCo = get_idCo_by_adherent($libel_cours_affiche, $idAdh);
	$cours_idCo = $tab_cours_idCo['cours_idCo'];
	$modificationCours = effacer_cours($cours_idCo, $idAdh);
	/*
	if(mysqli_affected_rows($connexion) > 0) {
		echo "<div class = 'div_modif'> <p class='notification'>" . "Modification effectué avec succès !" . "</p> </div>";
	}
	*/
}


//Dining39Graves


?>