--Emmanuel Gokana
--Jofre Coll Vila
CREATE TABLE Adresse(
   idAdr INT NOT NULL AUTO_INCREMENT,
   numVoie INT,
   rue VARCHAR(50),
   complRue VARCHAR(50),
   boite INT,
   cedex INT,
   code_postal VARCHAR(80),
   ville VARCHAR(50),
   pays VARCHAR(50),
   PRIMARY KEY(idAdr)
);

CREATE TABLE Employé(
   idE INT NOT NULL AUTO_INCREMENT ,
   nomEmp VARCHAR(50),
   prenomEmp VARCHAR(50),
   PRIMARY KEY(idE)
); 

CREATE TABLE Période(
   annee INT,
   PRIMARY KEY(annee)
);

CREATE TABLE Séance(
   idS INT,
   Jour VARCHAR(50),
   Créneau TIME,
   PRIMARY KEY(idS)
); 

CREATE TABLE Féderation(
   idFed INT NOT NULL AUTO_INCREMENT,
   Sigle VARCHAR(50),
   NomF VARCHAR(50),
   PresidentFed VARCHAR(50),
   idAdr INT NOT NULL,
   PRIMARY KEY(idFed),
   FOREIGN KEY(idAdr) REFERENCES Adresse(idAdr)
); 

CREATE TABLE Comité(
   idCom INT  NOT NULL AUTO_INCREMENT,
   niveau VARCHAR(50),
   nomCom VARCHAR(50),
   idFed INT NOT NULL,
   PRIMARY KEY(idCom),
   FOREIGN KEY(idFed) REFERENCES Féderation(idFed),
); --MAUVAIS idCom_1

CREATE TABLE Compétiton(
   idCompet INT NOT NULL AUTO_INCREMENT,
   CodeComp VARCHAR(50),
   Libellé VARCHAR(50),
   Niveau VARCHAR(50),
   idCom INT NOT NULL,
   idFed INT NOT NULL,
   PRIMARY KEY(idCompet),
   FOREIGN KEY(idCom) REFERENCES Comité(idCom),
   FOREIGN KEY(idFed) REFERENCES Féderation(idFed)
); 

CREATE TABLE Struct_sportive(
   NomStruct VARCHAR(50),
   TypeStruct VARCHAR(50),
   adresse VARCHAR(50),
   PRIMARY KEY(NomStruct)
); 

CREATE TABLE Groupe_de_danse(
   idGroup INT NOT NULL AUTO_INCREMENT,
   Genre VARCHAR(50),
   numLicence1 VARCHAR(50),
   numLicence2 VARCHAR (50),
   NomGrp VARCHAR(50),
   PRIMARY KEY(idGroup)
);

CREATE TABLE types_danse(
   idTypeDanse INT NOT NULL AUTO_INCREMENT,
   nomTypeDanse VARCHAR (50),
   PRIMARY KEY(idTypeDanse)
); 

CREATE TABLE École(
   idE INT NOT NULL AUTO_INCREMENT,
   nomE VARCHAR(50),
   fondateurs VARCHAR(50),
   idFed INT NOT NULL,
   idAdr INT NOT NULL,
   PRIMARY KEY(idE),
   FOREIGN KEY(idFed) REFERENCES Féderation(idFed),
   FOREIGN KEY(idAdr) REFERENCES Adresse(idAdr)
);

CREATE TABLE Salle(
   idE INT,
   idS INT,
   nomS VARCHAR(50),
   superficie DOUBLE,
   PRIMARY KEY(idE, idS),
   FOREIGN KEY(idE) REFERENCES École(idE)
); 

CREATE TABLE Espace_danse(
   idE INT,
   idS INT,
   type_aération VARCHAR(50),
   type_chauffage VARCHAR(50),
   PRIMARY KEY(idE, idS),
   FOREIGN KEY(idE, idS) REFERENCES Salle(idE, idS)
); 

CREATE TABLE Vestiaire(
   idE INT,
   idS INT,
   mixte BOOL,
   douche BOOL,
   PRIMARY KEY(idE, idS),
   FOREIGN KEY(idE, idS) REFERENCES Salle(idE, idS)
);

CREATE TABLE cours(
   idCo INT NOT NULL AUTO_INCREMENT,
   Libellé VARCHAR(50),
   Catégorie VARCHAR(50),
   idE INT NOT NULL,
   PRIMARY KEY(idCo),
   FOREIGN KEY(idE) REFERENCES  École(idE)
); 

CREATE TABLE Adhérent(
   idAdh INT NOT NULL AUTO_INCREMENT,
   nomAdh VARCHAR(50),
   prenomAdh VARCHAR(50),
   dateNaiss DATE,
   idAdr INT NOT NULL,
   idGroup INT NOT NULL,
   PRIMARY KEY(idAdh),
   FOREIGN KEY(idAdr) REFERENCES Adresse(idAdr),
   FOREIGN KEY(idGroup) REFERENCES Groupe_de_danse(idGroup)
);--AUTO_INCREMENT = 2022001;

CREATE TABLE Cours_zumba(
   idCo INT,
   Ambiance VARCHAR(50),
   PRIMARY KEY(idCo),
   FOREIGN KEY(idCo) REFERENCES cours(idCo)
);

CREATE TABLE Cours_éveil_danse(
   idCo INT,
   PRIMARY KEY(idCo),
   FOREIGN KEY(idCo) REFERENCES cours(idCo)
); 

CREATE TABLE Cours_danse(
   idCo INT,
   Catégorie_danse VARCHAR(50),
   PRIMARY KEY(idCo),
   FOREIGN KEY(idCo) REFERENCES cours(idCo)
);

CREATE TABLE Certificat_médical(
   idCert INT NOT NULL AUTO_INCREMENT,
   annee INT NOT NULL,
   idAdh INT NOT NULL,
   PRIMARY KEY(idCert),
   FOREIGN KEY(annee) REFERENCES Période(annee),
   FOREIGN KEY(idAdh) REFERENCES Adhérent(idAdh)
); 

CREATE TABLE Edition(
   idCompet INT,
   Code VARCHAR (80),
   Code_Année VARCHAR(50),
   Ville_orga VARCHAR(50),
   NomStruct VARCHAR(50) NOT NULL,
   PRIMARY KEY(idCompet, Code_Année),
   FOREIGN KEY(idCompet) REFERENCES Compétiton(idCompet),
   FOREIGN KEY(NomStruct) REFERENCES Struct_sportive(NomStruct)
);

CREATE TABLE travail(
   idE INT,
   idE_1 INT,
   annee INT,
   fonction VARCHAR(50),
   PRIMARY KEY(idE, idE_1, annee),
   FOREIGN KEY(idE) REFERENCES École(idE),
   FOREIGN KEY(idE_1) REFERENCES Employé(idE),
   FOREIGN KEY(annee) REFERENCES Période(annee)
);

CREATE TABLE a_pour_influence(
   idTypeDanse INT,
   idTypeDanse_1 INT,
   PRIMARY KEY(idTypeDanse, idTypeDanse_1),
   FOREIGN KEY(idTypeDanse) REFERENCES types_danse(idTypeDanse),
   FOREIGN KEY(idTypeDanse_1) REFERENCES types_danse(idTypeDanse)
); 

CREATE TABLE est_inscrit(
   idCo INT,
   idAdh INT NOT NULL,
   annee INT,
   PRIMARY KEY(idCo, idAdh),
   FOREIGN KEY(idCo) REFERENCES cours(idCo),
   FOREIGN KEY(idAdh) REFERENCES Adhérent(idAdh)
); 


CREATE TABLE se_déroule(
   idCo INT,
   idS INT,
   PRIMARY KEY(idCo, idS),
   FOREIGN KEY(idCo) REFERENCES cours(idCo),
   FOREIGN KEY(idS) REFERENCES Séance(idS)
); 

CREATE TABLE participe(
   idCompet INT,
   Code VARCHAR(80),
   Code_Année VARCHAR(50),
   idGroup INT,
   NumeroPass1 INT,
   NumeroPass2 INT,
   RangFinal VARCHAR(50),
   PRIMARY KEY(idCompet, Code_Année, idGroup),
   FOREIGN KEY(idCompet, Code_Année) REFERENCES Edition(idCompet,Code_Année),
   FOREIGN KEY(idGroup) REFERENCES Groupe_de_danse(idGroup)
); 

CREATE TABLE comporte(
   idCo INT,
   idTypeDanse INT,
   PRIMARY KEY(idCo, idTypeDanse),
   FOREIGN KEY(idCo) REFERENCES Cours_danse(idCo),
   FOREIGN KEY(idTypeDanse) REFERENCES types_danse(idTypeDanse)
); 

CREATE TABLE est_inscrit_a_ecole(
   idE INT,
   idAdh INT,
   annee INT,
   PRIMARY KEY(annee,idE, idAdh),
   FOREIGN KEY(idE) REFERENCES École(idE),
   FOREIGN KEY(idAdh) REFERENCES Adhérent(idAdh),
    FOREIGN KEY(annee) REFERENCES Période(annee)
); 

CREATE TABLE  Membre_fed(
   idMem INT NOT NULL AUTO_INCREMENT,
   NomM VARCHAR(50),
   PrenomM VARCHAR(50),
   date_naiss VARCHAR(15),
   idFed INT NOT NULL,
   PRIMARY KEY(idMem),
   FOREIGN KEY(idFed) REFERENCES Féderation(idFed)
);
