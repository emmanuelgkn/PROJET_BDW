<?php 

$idAdr = null;
$message_liste = "";
$message_details = "";

// Affichage nom adhérent
$responsables = get_nomResp();

if($responsables == null || count($responsables) == 0) {
	$message_liste = "Aucun nom n'a été trouvée dans la base de données !";
}



if(isset($_POST['boutonAfficher'])) {

	$responsablesAffiche = mysqli_real_escape_string($connexion, trim($_POST['fondateurs']));

	// Affichage nom école
	$tab_nomEcole = get_nomEcole($responsablesAffiche);
	$nomEcole = $tab_nomEcole['nom_ecole'];

	// Affichage adresse école
    $tab_idAdresse_ecole = get_idAdresse_by_Fondateur ($responsablesAffiche); 
    $idAdr = $tab_idAdresse_ecole['idAdr'];
    $adresse_ecole = get_Adresse_Ecole_by_idAdresse($idAdr);

	// Affichage emplyés école
	$liste_employes = get_liste_employes_by_fondateur ($responsablesAffiche);

	// Affichage nombre d'adhérents
	$tab_nombre_adherents = get_nombre_adherents_annee_en_cours($responsablesAffiche);
	$nombre_adherents = $tab_nombre_adherents['total_adhérents'];

	// Affichage cours proposés
	$liste_cours_proposes = get_liste_cours_proposes($responsablesAffiche);

	$_SESSION['idAdr'] = $idAdr;


}

	if(isset($_POST['boutonModifier'])){
	$idAdr = $_SESSION['idAdr'];
	$nomEcoleModif = mysqli_real_escape_string($connexion, trim($_POST['nomEcoleModif']));
	$fondateursModif = mysqli_real_escape_string($connexion, trim($_POST['fondateursModif']));
	$numVoieModif = mysqli_real_escape_string($connexion, trim($_POST['numVoieModif']));
	$rueModif = mysqli_real_escape_string($connexion, trim($_POST['rueModif']));
	$code_postalModif = mysqli_real_escape_string($connexion, trim($_POST['code_postalModif']));
	$villeModif = mysqli_real_escape_string($connexion, trim($_POST['villeModif']));
	$modificationsEcole = modifier_ecole($nomEcoleModif, $fondateursModif, $numVoieModif, $rueModif, $code_postalModif, $villeModif, $idAdr);
	}	



?>