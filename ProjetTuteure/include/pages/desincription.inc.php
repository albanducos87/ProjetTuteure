
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$idPersonne = $personneManager->getIdByLogin($_SESSION["login"]);
if (!empty($_SESSION["etudiant"])){
    $etudiantManager = new EtudiantManager($pdo);
    $cvManager = new CvManager($pdo);
    $cvdeManager = new CvdeManager($pdo);
    $demandeManager = new DemandeManager($pdo);
    $demandeManager->deleteDemandeEtudiant($idPersonne);
    $listCV = $cvdeManager->getListCvde($idPersonne);
    $cvdeManager->deleteCvde($idPersonne);
    foreach($listCV as $cv){
        $cvManager->supprimerCV($cv->getId_cv());
    }
    $etudiantManager->deleteEtudiant($idPersonne);
   
}
if (!empty($_SESSION["responsable"])){
    $responsableEtudiantManager = new ResponsableEtudiantManager($pdo);
    $responsableEtudiantManager->deleteResponsableEtudiant($idPersonne);
}
if (!empty($_SESSION["entreprise"])){
    $entrepriseManager = new entrepriseManager($pdo);
    $idEntreprise = $entrepriseManager->getIdEntrepriseById($idPersonne);
    $demandeManager = new DemandeManager($pdo);
    $responsableEntrepriseManager = new ResponsableEntrepriseManager($pdo);
    $stageManager = new StageManager($pdo);
    $listStages = $stageManager->getStagesByIdEntreprise($idEntreprise);
    foreach($listStages as $stage) {
        $demandeManager->deleteDemandeByIdStage($stage->getId_stage());
    }
    $stageManager->deleteStages($idEntreprise);
    $responsableEntrepriseManager->deleteResponsableEntreprise($idPersonne);
    $entrepriseManager->deleteEntreprise($idEntreprise);
}
$personneManager->deletePersonne($idPersonne);
?>
    <?php
    session_destroy();
    header("Refresh: 2;url='index.php?page=0'");
    ?>
<h1> Vous vous êtes désinscrit </h1>