<div class="container font-weight-light pb-5">
        <h1 class="font-weight-light">Demandes reçues</h1><br>

        <?php
        $pdo = new Mypdo();
        $demande = new DemandeManager($pdo);
        $personne = new PersonneManager($pdo);
        $entrepriseCo = $_SESSION["login"];
        $entreprise = new EntrepriseManager($pdo);
        $stage = new StageManager($pdo);
        $responsableCo = $personne->getIdByLogin($entrepriseCo);

        $idEntreprise = $entreprise->getIdEntrepriseById($responsableCo);

        $Stage = $stage->getIdStageByIdEntreprise($idEntreprise);

        if($Stage == NULL){?>
            <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
            <h5 class="font-weight-light">Aucune demande reçue.</h5>
        </div><?php
        }else{
            ?><table class="table border border-dark">
            <thead class="text-white ">
            <tr id="tetetabbleu">
                <th class="font-weight-light text-center">Etudiant Postulant</th>
                <th class="font-weight-light text-center">Titre du Stage</th>
                <th class="font-weight-light text-center">CV</th>
                <th class="font-weight-light text-center">Etat</th>
            </tr>
            </thead>
            <?php foreach($Stage as $idStage){
                $Stage = $idStage->getId_Stage();
                $Etu = $demande->getIdEtuByIdStage($Stage);

                foreach($Etu as $id){
                    $Etu = $id->getId_etudiant();

                    $titre = $stage->getTitreById($Stage);
                    $nom = $personne->getNomById($Etu);
                    $prenom = $personne->getPrenomById($Etu); ?>

                    <tr class="table-secondary font-weight-light">
                        <th scope="row"><?php echo $nom;echo " "; echo $prenom?></th>
                        <td><?php echo $titre;?></td>
                        <td class="text-center"><a href="<?php echo "index.php?page=34&idCV=".$Stage?>">CV</a></td>
                        <td class="text-center"><?php ?></td>
                    </tr>
                <?php   }
            } ?>
            </table>
        <?php }
        ?>
</div>
