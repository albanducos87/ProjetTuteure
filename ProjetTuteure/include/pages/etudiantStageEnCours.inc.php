<?php
$pdo=new Mypdo();
$VilleManager = new VilleManager($pdo);
$DiplomeManager = new DiplomeManager($pdo);
$StageManager = new StageManager($pdo);
$EntrepriseManager = new EntrepriseManager($pdo);
$demandeManager = new DemandeManager($pdo);
$personneManager = new PersonneManager($pdo);
$idEtu = $personneManager->getIdByLogin($_SESSION["login"]);
$stageAccepte = $demandeManager->getEtudiantIfAccepted($idEtu);
if(null != $stageAccepte){
$stageAcc = $StageManager->getStageById($stageAccepte->getId_stage());
foreach($stageAcc as $stage){
?>

<div id="detailstage" class="col shadow-lg p-3 mb-5 font-weight-light rounded">
    <h2 class="font-weight-light"><?php echo $stage->getTitre(); ?></h4>
    <hr class="style1">
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-tasks"></i> <b>Mission :</b> <?php echo $stage->getMission(); ?><br>
            </div>
            <div class="col-6" >
                <i class="fa fa-clock-o"></i> <b>Durée :</b> <?php echo $stage->getNbSemaines(); ?> semaines a partir du <?php echo $stage->getDateDebut(); ?><br>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-suitcase"></i> <b>Entreprise :</b> <?php echo $EntrepriseManager->getNomEntById($stage->getId_entreprise());?> à <?php echo $VilleManager->getVilleById($stage->getId_ville());?><br>
            </div>
            <div class="col-6">
                <i class="fa fa-tag"></i> <b>Diplome requis :</b> <?php echo $DiplomeManager->getNomDiplomeById($stage->getId_diplome());?> niveau <?php echo $DiplomeManager->getNiveauDiplomeById($stage->getId_diplome());?><br>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-comments"></i> <b>Langues requises : </b><?php echo $stage->getLangueRequise();?>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-pencil"></i> <b> Description :</b> <?php  echo $stage->getDescriptionStage() ?>.<br>
            </div>
        </div>

</div>
<?php
}
}else{
?>
<h1>Aucun Stage en cours.</h1>
<?php
}
?>

