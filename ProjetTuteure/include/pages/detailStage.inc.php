<?php
$pdo=new Mypdo();
$VilleManager = new VilleManager($pdo);
$DiplomeManager = new DiplomeManager($pdo);
$StageManager = new StageManager($pdo);
$EntrepriseManager = new EntrepriseManager($pdo);
$listeVille = $VilleManager->getAllVilles();
$listeDiplome = $DiplomeManager->getAllDiplomes();
$ListeStage = $StageManager->getStageById($_GET['idStage']);
foreach ($ListeStage as $Stage){
	$stage = $Stage;
}
?>
<div id="detailstage" class="col shadow-lg p-3 mb-5 font-weight-light rounded">
    <h4 class="font-weight-light"><?php echo $stage->getTitre(); ?></h4>
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
        <?php 
        if(!empty($_SESSION["personne"])&& $_SESSION["personne"] != null){
            ?>
             <a href="index.php?page=33&amp;idStage=<?php echo $stage->getId_stage();?>" class="fa fa-plus-circle"> Postuler</>
        <?php
        }else{
            ?>
    <p class="font-weight-bolder">Connectez vous pour postuler!</p><?php
        }
        ?>       

</div>