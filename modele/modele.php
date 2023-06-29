<?php 

/*
Structure de données permettant de manipuler une base de données :
- Gestion de la connexion
----> Connexion et déconnexion à la base
- Accès au dictionnaire
----> Liste des tables et statistiques
- Informations (structure et contenu) d'une table
----> Schéma et instances d'une table
- Traitement de requêtes
----> Schéma et instances résultant d'une requête de sélection
*/



////////////////////////////////////////////////////////////////////////
///////    Gestion de la connxeion   ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

/**
 * Initialise la connexion à la base de données courante (spécifiée selon constante 
 *	globale SERVEUR, UTILISATEUR, MOTDEPASSE, BDD)			
 */
function open_connection_DB() {
	global $connexion;

	$connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
}

/* *
 *  Ferme la connexion courante
 * */
function close_connection_DB() {
	global $connexion;

	mysqli_close($connexion);
}

// Retourne les noms de tous les adhérents
function get_nomAdherent() {
	global $connexion;

	$requete = "SELECT nomAdh, prenomAdh FROM p2100037.Adhérent";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne les noms de tous les membres
function get_nomMembre() {
	global $connexion;

	$requete = "SELECT NomM, PrenomM, idMem FROM p2100037.Membre_fed ORDER BY NomM";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne les prenoms de tous les adhérents
function get_prenomAdherent(){
	global $connexion;

	$requete = "SELECT prenomAdh FROM p2100037.Adhérent";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}


function get_idAdh_by_nom_prenom ($nomAdh, $prenomAdh){
	global $connexion;
	
	$requete = "SELECT idAdh AS idA FROM p2100037.Adhérent WHERE nomAdh = '$nomAdh' AND prenomAdh = '$prenomAdh'";
	
	$res = mysqli_query($connexion, $requete);
	
	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . "\n";
		return null;
	}

	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['idA'] = $row['idA'];
	}

	return $resultat;
}


// Retourne les cours auxquels l'adhérent est inscrit
function get_cours_by_adherent($idAdh) {
    global $connexion;

	$requete = "SELECT DISTINCT C.libellé AS libel_cours FROM p2100037.cours C JOIN est_inscrit E ON C.idCo = E.idCo AND E.idAdh = '$idAdh'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_idCo_by_adherent($cours_libelle, $idAdh) {
    global $connexion;

	$requete = "SELECT DISTINCT C.idCo AS cours_idCo FROM p2100037.cours C JOIN est_inscrit E ON C.idCo = E.idCo AND E.idAdh = '$idAdh' AND C.Libellé = '$cours_libelle'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}

	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['cours_idCo'] = $row['cours_idCo'];
	}
	
	return $resultat;
}

function get_idCo_by_ecole($cours_libelle, $idAdh) {
    global $connexion;

	//$requete = "SELECT DISTINCT C.idCo AS cours_idCo FROM p2100037.cours C JOIN est_inscrit E ON C.idCo = E.idCo AND E.idAdh = '$idAdh' AND C.Libellé = '$cours_libelle'";
	$requete = "SELECT DISTINCT C.idCo AS cours_idCo 
				FROM p2100037.cours C, p2100037.est_inscrit_a_ecole Es_a WHERE Es_a.idAdh = '$idAdh' AND C.idE = Es_a.idE AND C.Libellé = '$cours_libelle'";

	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}

	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['cours_idCo'] = $row['cours_idCo'];
	}
	
	return $resultat;
}

function get_liste_cours_ecole($idAdh){
	global $connexion;

	$requete = "SELECT DISTINCT C.libellé AS libel_cours_ecole FROM p2100037.cours C JOIN est_inscrit_a_ecole E ON E.idAdh = '$idAdh' AND E.idE = C.idE";

	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function ajouter_cours($idCo, $idAdh){
	global $connexion;

	$requete = "INSERT INTO p2100037.est_inscrit (idCo, idAdh) VALUES ('$idCo', '$idAdh');";


	$res = mysqli_query($connexion, $requete);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;	
}

function effacer_cours($idCo, $idAdh){
	global $connexion;

	$requete = "DELETE FROM est_inscrit WHERE idCo = '$idCo' AND idAdh = '$idAdh'";

	$res = mysqli_query($connexion, $requete);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;
}


// identification responsable d'une école
function get_nomResp(){
	global $connexion;

	$requete = "SELECT E.fondateurs FROM p2100037.École E ORDER BY  E.fondateurs ASC;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne le nom d'une école avec un fondateur en entrée
function get_nomEcole($fondateur){
	global $connexion;

    $requete = "SELECT E.nomE AS nom_ecole FROM p2100037.École E WHERE E.fondateurs = '$fondateur'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}

	// on retourne un tableau	
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['nom_ecole'] = $row['nom_ecole'];
	}

	return $resultat;
}

// Retourne l'identifiant d'une adresse
function get_idAdresse_by_Fondateur ($fondateur){
	global $connexion;
	
	$requete = "SELECT A.idAdr AS idAdr FROM p2100037.Adresse A JOIN p2100037.École E ON A.idAdr = E.idAdr AND E.fondateurs = '$fondateur'";
	
	$res = mysqli_query($connexion, $requete);
	
	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . "\n";
		return null;
	}

	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['idAdr'] = $row['idAdr'];
	}

	return $resultat;
}

// Rertourne l'adresse d'une école à partir d'un identifiant
function get_Adresse_Ecole_by_idAdresse($idAdr){
	global $connexion;

    $requete = "SELECT A.numVoie, A.rue, A.code_postal, A.ville, A.pays FROM p2100037.Adresse A WHERE A.idAdr = '$idAdr'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_liste_employes_by_fondateur ($fondateur){
	global $connexion;

    $requete = "SELECT Em.nomEmp, Em.prenomEmp FROM Employé Em JOIN École Ec ON Em.idE = Ec.idE AND Ec.fondateurs = '$fondateur'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

function get_nombre_adherents_annee_en_cours($fondateur){
	global $connexion;

    $requete = "SELECT COUNT(*) AS total_adhérents FROM Adhérent A JOIN est_inscrit_a_ecole E ON A.idAdh = E.idAdh AND E.annee = YEAR(CURDATE()) JOIN École Ec ON E.idE = Ec.idE AND Ec.fondateurs = '$fondateur';";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['total_adhérents'] = $row['total_adhérents'];
	}

	return $resultat;
}

function get_liste_cours_proposes($fondateur){
	global $connexion;

    $requete = "SELECT C.Libellé FROM cours C JOIN École E ON C.idE = E.idE AND E.fondateurs = '$fondateur'";
	$res = mysqli_query($connexion, $requete);

	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}
// Permet d'executer une requette
function executer_une_requete($requete) {
	
	global $connexion;

	// récupération des informations sur la table (schema + instance)
 	$res = mysqli_query($connexion, $requete);  

	if(gettype($res) != "boolean")
	{
		// extraction des informations sur le schéma à partir du résultat précédent
		$infos_atts = mysqli_fetch_fields($res); 

		// filtrage des information du schéma pour ne garder que le nom de l'attribut
		$schema = array();
		foreach( $infos_atts as $att ){
			array_push( $schema , array( 'nom' => $att->{'name'} ) ); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
		}

		// récupération des données (instances) de la table
		$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

		// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
		return array('schema'=> $schema , 'instances'=> $instances);
	}
 	return null;
}


//modifier un element de la base
function modifier_membre($nom,$prenom,$date,$idM)
{
	global $connexion;

	$requete = "UPDATE p2100037.Membre_fed SET NomM = '$nom' , PrenomM = '$prenom', date_naiss = '$date' WHERE idMem = $idM";

	$res = mysqli_query($connexion, $requete);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;	
}

function ajouter_membre($nom,$prenom,$date)
{
	global $connexion;

	$requete = "INSERT INTO p2100037.Membre_fed (NomM, PrenomM, date_naiss, idFed) VALUES ('$nom', '$prenom', '$date', 1) ;";

	$res = mysqli_query($connexion, $requete);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;	
}

function modifier_ecole($nomEcole, $fondateur, $numVoie, $rue, $code_postal, $ville, $idAdr){
	global $connexion;

	$requete="UPDATE p2100037.École E
	JOIN p2100037.Adresse A ON E.idAdr = A.idAdr AND A.idAdr = '$idAdr'
	SET E.nomE = '$nomEcole',
		E.fondateurs = '$fondateur',
		A.numVoie = '$numVoie',
		A.rue = '$rue',
		A.code_postal = '$code_postal',
		A.ville = '$ville';";
	$res = mysqli_query($connexion, $requete);
	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	return true;	
}

function get_competitions(){
	global $connexion;

	$requete = "SELECT DISTINCT C.Libellé FROM p2100037.Compétiton C ORDER BY C.Libellé ASC;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;	
}

function get_codeCompetitions($nomComp){
	global $connexion;

	$requete = "SELECT DISTINCT C.CodeComp FROM p2100037.Compétiton C WHERE C.Libellé = '$nomComp';";

	$res = mysqli_query($connexion, $requete);
	
	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . "\n";
		return null;
	}

	// on retourne un tableau
	$resultat = array();

	while($row = mysqli_fetch_assoc($res)){
		$resultat['CodeComp'] = $row['CodeComp'];
	}

	return $resultat;
}

function get_liste_edition($CodeComp){
	global $connexion;

	$requete = "SELECT E.idCompet, E.Code, E.Code_Année, E.Ville_orga, E.NomStruct  FROM p2100037.Edition E WHERE E.Code = '$CodeComp' ORDER BY E.Code_Année DESC;";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;	
}

function modifier_competition($LibelléModif, $CodeCompModif, $NiveauModif, $Libellé, $CodeComp){
	global $connexion;

	$requete="UPDATE p2100037.Compétiton C, p2100037.Edition E
	SET C.Libellé = '$LibelléModif',
		C.CodeComp = '$CodeCompModif',
		C.Niveau = '$NiveauModif',
		E.Code = '$CodeCompModif'
		WHERE C.Libellé = '$Libellé'AND E.Code = '$CodeComp';";

	$res = mysqli_query($connexion, $requete);
	if (!$res) {
		echo "Erreur MySQL : " . mysqli_error($connexion) . PHP_EOL;
		return null;
	}
	return true;	
}

function ajouter_competition($LibelléAjouter, $CodeCompAjouter, $NiveauAjouter){
	global $connexion;

	for ($i = 1; $i <= 128; $i++) {

		$requete = "INSERT INTO p2100037.Compétiton (Libellé, CodeComp, Niveau, idCom, idFed) 
					VALUES ('$LibelléAjouter', '$CodeCompAjouter', '$NiveauAjouter', '$i', 1)";

		$res = mysqli_query($connexion, $requete);

		if ($res == FALSE) { // falla si FALSE
			return false;
		}
	}
	return true;	
}

function ajouter_edition($code, $annee, $ville,$struct)
{
	global $connexion;
	$req = "INSERT INTO p2100037.Edition (Code, Code_Année, Ville_orga, NomStruct) VALUES ('$code', $annee, '$ville', '$struct') ;";
	$res = mysqli_query($connexion, $req);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;	
}

function supprimer_edition($idCom)
{
	global $connexion;
	$req= "DELETE FROM p2100037.Edition WHERE idCompet = $idCom";
	$res = mysqli_query($connexion, $req);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;
}

function supprimer_competition($Lib)
{
	global $connexion;
	$req = "DELETE FROM p2100037.Compétiton WHERE Libellé = '$Lib';";
	$res = mysqli_query($connexion, $req);
	if($res == FALSE){ // échec si FALSE

		return false;
	}
	return true;
}


?>
