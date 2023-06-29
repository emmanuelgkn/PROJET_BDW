<?php

$message = "";
$statun = executer_une_requete("SELECT A.nbFed, B.nbCR, C.nbCD
                                   FROM(SELECT count(*) as nbFed FROM Féderation) A,
                                       (SELECT count(*) as nbCR FROM Comité WHERE niveau = 'reg') B,
 	                                   (SELECT count(*) as nbCD FROM Comité WHERE niveau = 'dept') C;");

$statdeux = executer_une_requete("SELECT COUNT(E.idE) as nbEcoles, A.code
                                  FROM École E
	                                   JOIN (SELECT CASE LEFT(A.code_postal, 2) WHEN '97'
             	                                    THEN LEFT(A.code_postal, 3)
             	                                    ELSE LEFT(A.code_postal, 2) END as code, A.idAdr
     	                                     FROM Adresse A
     	                                     WHERE A.pays LIKE 'France') A
	                                         ON E.idAdr = A.idAdr
                                             GROUP BY A.code");

$statrois = executer_une_requete("SELECT DISTINCT C.nomCom as Comités
                                    FROM Féderation F JOIN  Comité C ON F.idFed = C.idFed
                                    WHERE F.NomF = 'Fédération Française de Danse'
                                    AND C.niveau = 'reg'
                                    ORDER BY C.nomCom DESC;");

$statquatre = executer_une_requete("SELECT E.nomE, A.ville, count(DISTINCT I.idAdh) as Nombre_Adhérents
                                    FROM École E JOIN Adresse A ON E.idAdr = A.idAdr
          	                                     JOIN est_inscrit_a_ecole I ON I.idE = E.idE
                                    WHERE A.pays = 'France' AND I.annee = '2022'
                                    GROUP BY E.nomE, A.ville
                                    ORDER BY Nombre_Adhérents DESC
                                    LIMIT 5;");
?>