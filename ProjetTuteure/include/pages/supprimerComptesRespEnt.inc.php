<h1> Suppression </h1>
<?php
$pdo = new Mypdo();
$demandeManager = new DemandeManager($pdo);
$entrepriseManager = new entrepriseManager($pdo);
$personneManager = new PersonneManager($pdo);
$demandeManager = new DemandeManager($pdo);
$responsableEntrepriseManager = new ResponsableEntrepriseManager($pdo);
$stageManager = new StageManager($pdo);
$idRespEnt = array();
for ($i = 0; $i <$_GET["nbRespEnt"]; $i++){
    $idRespEnt[] = $_GET["idRespEnt".$i];
}
foreach ($idRespEnt as $respEnt){
    $idEntreprise = $entrepriseManager->getIdEntrepriseById($respEnt);
    $listStages = $stageManager->getStagesByIdEntreprise($idEntreprise);
    foreach($listStages as $stage) {
        $demandeManager->deleteDemandeByIdStage($stage->getId_stage());
    }
    $stageManager->deleteStages($idEntreprise);
    $responsableEntrepriseManager->deleteResponsableEntreprise($respEnt);
    $entrepriseManager->deleteEntreprise($idEntreprise);
    $personneManager->deletePersonne($respEnt);
}
?>
<?php if ($_GET["nbRespEnt"] > 0) { ?>
    <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les responsables sélectionnés ont étés supprimés.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>
    <?php

    header("Refresh: 2;url='index.php?page=36'");
}
else{
    header("Refresh: 0;url='index.php?page=36'");
}


    
?>