<?php

$message ="";

$reqAdrF = executer_une_requete("SELECT numVoie, rue, code_postal, ville 
                                 FROM Féderation F JOIN Adresse A ON F.idAdr = A.idAdr");

$Adrfed = $reqAdrF['instances'][0];

$reqnbCom =  executer_une_requete("SELECT count(*) as nbC
                                    FROM Comité");

$nbCom = $reqnbCom['instances'][0];

$recCompet = executer_une_requete("SELECT DISTINCT Libellé
                                    FROM Compétiton C JOIN Féderation F ON C.idFed = F.idFed
                                    WHERE F.idFed = 1");

$reqnbMembres = executer_une_requete("SELECT count(*) as nbM
                                    FROM Membre_fed");

$bnMem = $reqnbMembres['instances'][0];

?>