--Emmanuel Gokana
--Jofre Coll Vila

INSERT INTO Adresse (numVoie, rue, code_postal, ville) 
SELECT DISTINCT adr_fede_numVoie, adr_fede_rue, adr_fede_cp, adr_fede_ville 
FROM donnees_fournies.instances1

INSERT INTO Adresse (numVoie, rue, code_postal, ville) 
SELECT DISTINCT adr_comite_reg_numVoie, adr_comite_reg_rue, adr_comite_reg_cp, adr_comite_reg_ville 
FROM donnees_fournies.instances1

INSERT INTO Adresse (numVoie, rue, code_postal, ville) 
SELECT DISTINCT adr_ecole_numVoie, adr_ecole_rue, adr_ecole_cp, adr_ecole_ville 
FROM donnees_fournies.instances3

INSERT INTO Adresse (numVoie, rue, code_postal, ville) 
SELECT DISTINCT adr_danseur_numVoie, adr_danseur_rue, adr_danseur_cp, adr_danseur_ville 
FROM donnees_fournies.instances4

INSERT INTO Employé (idE, nomEmp, prenomEmp)
SELECT DISTINCT E.idE, cours_resp_nom, cours_resp_prénom 
FROM donnees_fournies.instances3 I3 INNER JOIN École E ON E.nomE = I3.ecole_nom 
AND E.fondateurs = I3.ecole_fondateur

INSERT INTO Période (annee) 
SELECT DISTINCT annee_inscription 
FROM donnees_fournies.instances4

INSERT INTO Féderation (Sigle, NomF, PresidentFed, idAdr) 
SELECT DISTINCT fede_sigle, fede_nom, fede_dirigeant, 1 
FROM donnees_fournies.instances1

INSERT INTO Comité (libellé, idFed) 
SELECT DISTINCT comite_reg_nom, 1 
FROM donnees_fournies.instances1

INSERT INTO Comité (niveau, nomCom, idFed) 
SELECT comite_dept_niveau, comite_dept_nom,F.idFed 
FROM Feédération F, donnees_fournies.instances1

INSERT INTO Compétiton (CodeComp, Libellé, Niveau, idCom, idFed) 
SELECT DISTINCT I2.compet_code, I2.compet_libellé, I2.compet_niveau, C.idCom, 1 
FROM donnees_fournies.instances2 I2, donnees_fournies.instances1 I1 INNER JOIN Comité C ON C.niveau = I1.comite_dept_niveau 
AND C.nomCom = I1.comite_dept_nom

INSERT INTO types_danse(nomTypeDanse) 
SELECT DISTINCT cours_libellé 
FROM donnees_fournies.instances3

INSERT INTO École (nomE, fondateurs, idFed, idAdr) 
SELECT DISTINCT I3.ecole_nom, I3.ecole_fondateur, 1, A.idAdr
FROM donnees_fournies.instances3 I3 INNER JOIN Adresse A ON (A.numVoie = I3.adr_ecole_numVoie) 
AND (A.rue=I3.adr_ecole_rue)

INSERT INTO Groupe_de_danse (Genre, NomGrp) 
SELECT cours_libellé, ecole_nom 
FROM donnees_fournies.instances3

INSERT INTO Adhérent (nomAdh, prenomAdh, idAdr, idGroup) 
SELECT DISTINCT danseur_nom, danseur_prenom, A.idAdr, 1 
FROM donnees_fournies.instances4 I4 INNER JOIN Adresse A ON A.numVoie = I4.adr_danseur_numVoie 
AND A.rue = I4.adr_danseur_rue

INSERT INTO Certificat_médical (annee, idAdh) 
SELECT annee_inscription, danseur_numLicence 
FROM donnees_fournies.instances4

INSERT INTO cours (Libellé, Catégorie, idE) 
SELECT cours_libellé, cours_categorie_age, E.idE FROM donnees_fournies.instances3 I3 INNER JOIN École E ON E.nomE = I3.ecole_nom 
AND E.fondateurs = I3.ecole_fondateur
