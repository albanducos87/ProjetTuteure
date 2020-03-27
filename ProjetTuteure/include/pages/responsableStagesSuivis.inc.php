
<h1 class="font-weight-light">Suivi des stages</h1>
<br>

      <?php
      $pdo = new Mypdo();
      $demandeManager = new DemandeManager($pdo);
      $personneManager = new PersonneManager($pdo);
      $etudiantManager = new EtudiantManager($pdo);
      $responsableEtudiantManager = new ResponsableEtudiantManager($pdo);
      $villeManager = new VilleManager($pdo);
      $entrepriseManager = new EntrepriseManager($pdo);
      $stageManager = new StageManager($pdo);
      $respEtudiant = $personneManager->getIdByLogin($_SESSION["login"]);
      $idEta = $responsableEtudiantManager->getIdEtablissementById($respEtudiant);
      $listEtudiant = $etudiantManager->getListeMesEtudiants($idEta);
      if(empty($listEtudiant)){
          ?>
          <div id="aucunReponsable" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
              <h5 class="font-weight-light"> Il n'y a aucun stage a suivre</h5>
          </div><?php

      }
      foreach($listEtudiant as $etu){
          $demande = $demandeManager->getEtudiantIfAccepted($etu->getId_Etudiant());
          
          if (!empty($demande)){
              ?>
                <div class="container">
                    <table class="table border border-dark">
                        <thead class="text-white">
                        <tr id="tetetabbleu">
                            <th class=" text-center font-weight-light">Etudiant</th>
                            <th class="text-center font-weight-light">Libellé du stage</th>
                            <th class="text-center font-weight-light">Lieu</th>
                            <th class="text-center font-weight-light">Date de début</th>
                            <th class="text-center font-weight-light">Nombre de semaines</th>
                            <th class="text-center font-weight-light">Etat</th>
                        </tr>
                        </thead>
                        <tbody>
        <?php
              $stage = $stageManager->toObject($demande->getId_stage());
              $dureeEnJours = $stage->getNbSemaines() * 7;
              $dateFin = date('Y-m-d', strtotime($stage->getDateDebut(). ' + '.$dureeEnJours.' days'));
              if (date('Y-m-d') < $dateFin ){
                  if (date('Y-m-d') > $stage->getDateDebut()){?>
                <tr class="table-primary">
				<th scope="text-center font-weight-light row"><?php echo $personneManager->getNomById($etu->getId_Etudiant())." ". $personneManager->getPrenomById($etu->getId_Etudiant())?></th>
				<td class="text-center font-weight-light"><?php echo $stage->getTitre()?></td>
				<td class="text-center font-weight-light"><?php echo $villeManager->getVilleByID($stage->getId_ville())?></td>
				<td class="text-center font-weight-light"><?php echo $stage->getDateDebut()?></td>
				<td class="text-center font-weight-light"><?php echo $stage->getNbSemaines()?></td>
				<td>En cours</td>
			</tr>
        		<?php 
                  }
                  else{?>
                  <tr class="table-warning">
                          <th scope="text-center font-weight-light row"><?php echo $personneManager->getNomById($etu->getId_Etudiant())." ". $personneManager->getPrenomById($etu->getId_Etudiant())?></th>
                          <td class="text-center font-weight-light"><?php echo $stage->getTitre()?></td>
                          <td class="text-center font-weight-light"><?php echo $villeManager->getVilleByID($stage->getId_ville())?></td>
                          <td class="text-center font-weight-light"><?php echo $stage->getDateDebut()?></td>
                          <td class="text-center font-weight-light"><?php echo $stage->getNbSemaines()?></td>
				<td>A venir</td>
			</tr>                      
              <?php     }
              }else {?>
                  <tr class="table-danger">
                      <th scope="text-center font-weight-light row"><?php echo $personneManager->getNomById($etu->getId_Etudiant())." ". $personneManager->getPrenomById($etu->getId_Etudiant())?></th>
                      <td class="text-center font-weight-light"><?php echo $stage->getTitre()?></td>
                      <td class="text-center font-weight-light"><?php echo $villeManager->getVilleByID($stage->getId_ville())?></td>
                      <td class="text-center font-weight-light"><?php echo $stage->getDateDebut()?></td>
                      <td class="text-center font-weight-light"><?php echo $stage->getNbSemaines()?></td>
         			 <td>Fini</td>
         		</tr>      
              <?php }
          }
      }
          ?>
      </tbody>
	</table>
</div>
