
<?php
    $pdo = new Mypdo();
    $demandeManager = new DemandeManager($pdo);
    $personneCo = new PersonneManager($pdo);
    $stageManager = new StageManager($pdo);
    $etudiantCo = $_SESSION["login"];
    $idPersonneCo = $personneCo->getIdByLogin($etudiantCo);
    $demandes = $demandeManager->getAllDemande($idPersonneCo);

    if (empty($demandes)){
        ?>
        <div id="mesDemandes" class="col shadow-lg p-3 mb-5 font-weight-light rounded">
    <h1 class="font-weight-light">Mes demandes</h1><?php
    	echo "Vous n'avez fait aucune demande...";
    	?>
</div>
<?php
    }else{
        ?>

    <h1 class="font-weight-light">Mes demandes</h1>
<br>
<div class="container pb-5">
    <table class="table border border-dark">
        <thead class="text-white">
            <tr id="tetetabbleu">
              <th class="text-center font-weight-light" >Stage</th>
              <th class="text-center font-weight-light">Description</th>
              <th class="text-center font-weight-light">Mission</th>
              <th class="text-center font-weight-light">Etat</th>

            </tr>
        </thead>
        <?php
	    foreach($demandes as $dem) {
	    	$description = $stageManager->getDescriptionById($dem->getId_stage());
	    	$titre = $stageManager->getTitreById($dem->getId_stage());
	    	$mission = $stageManager->getMissionById($dem->getId_stage());
	    	$accepte = $demandeManager->getAccepted($dem->getId_stage(),$idPersonneCo);
        ?>
        <tr class="table-secondary">
            <td class="font-weight-light" ><?php echo $titre;?></td>
            <td class="font-weight-light" ><?php echo $description;?></td>
            <td class="" ><?php echo $mission;?></td>
            <td class="text-center font-weight-light" ><?php
                if($accepte == 1) {?>
                    <p class="text-success">ACCEPTE</p></td>

                     <?php
                }else{
                ?>
                <p class="text-danger">REFUSE</p></td>
            <td><a id="annuler" href="index.php?page=32&idStage=<?php echo $dem->getId_stage()?>" class="btn btn-primary">ANNULER</a>
            <?php } ?></td>
        </tr>
    <?php } ?>
        </table>
        <?php
    }
?>
