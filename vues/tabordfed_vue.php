
<div class="tabfedivprince">
     <div class = "logo_tabordfed">
          <img src="img/logo_fede.png" alt="BD"/>
     </div>
     <div>
          <h1>TABLEAU DE BORD DE LA FEDERATION FRANCAISE DE DANSE</h1>
       </div>
     <div>
          <p>
               Bienvenue dans le tableau de bord de la FFD </br>
               On est situé au <?= $Adrfed['numVoie'] ?> <?= $Adrfed['rue'] ?>, <?= $Adrfed['code_postal'] ?>, <?= $Adrfed['ville'] ?></br>
               Nous possédons <?= $nbCom['nbC'] ?> comités</br>
               Nous avons <?= $bnMem['nbM'] ?> membres</br>
          </p>
     </div>
     <div class = "rescompet">
          <h2>Un apprerçu des compétitions que nous avons organisées</h2>
          <?php if( $message != "" ) { ?>

               <p class="notification"><?= $message ?></p>

          <?php }else{?>

          <table class="table_resultat_fed">
               <thead>
                    <tr>
                         <?php
                              //var_dump($statun);
                              foreach($recCompet['schema'] as $att) {  // pour parcourir les attributs

                                   echo '<th>';
                                   echo $att['nom'];
                                   echo '</th>';

                              }
                         ?>	
                    </tr>	
               </thead>
               <tbody>

                         <?php
                         foreach($recCompet['instances'] as $row) {  // pour parcourir les n-uplets

                                   echo '<tr>';
                                   foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets

                                        echo '<td>'. $valeur . '</td>';
                              }
                              echo '</tr>';
                         }
                         ?>
                         <?php }?>
               </tbody>
          </table>
     </div>
     <div class = "fonct_fed">
          <h1>Les différentes fonctionnalités proposées</h1>
          <ul>
          
          <li><a class="ligita">Gestion des informations de la fédération</a></li>
          <li><a class="ligita">Gestion des informations des comités</a></li>
          <li><a class="ligita" href="index.php?page=membre">Gestion des membres de la fédération</a></li>
          <li><a class="ligita" href="index.php?page=competition">Gestion des compétitions</a></li>
          </ul>
     </div>

</div>