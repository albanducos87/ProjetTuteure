<h1> Suppression </h1>
<?php
$pdo = new Mypdo();
$etudiantManager = new EtudiantManager($pdo);
$personneManager = new PersonneManager($pdo);
$cvManager = new CvManager($pdo);
$cvdeManager = new CvdeManager($pdo);
$demandeManager = new DemandeManager($pdo);
$idEtudiants = array();
for ($i = 0; $i <$_GET["nbEtudiant"]; $i++){
    $idEtudiants[] = $_GET["idEtudiant".$i];
}
foreach ($idEtudiants as $etudiant){
    
    $demandeManager->deleteDemandeEtudiant($etudiant);
    $listCV = $cvdeManager->getListCvde($etudiant);
    $cvdeManager->deleteCvde($etudiant);
    foreach($listCV as $cv){
        $cvManager->supprimerCV($cv->getId_cv());
    }
    $etudiantManager->deleteEtudiant($etudiant);
    $personneManager->deletePersonne($etudiant);
}
?>
<?php if ($_GET["nbEtudiant"] > 0) { ?>
    <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les étudiants sélectionnés ont étés supprimés.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>
    <?php
    header("Refresh: 2;url='index.php?page=35'");
}
else{
    header("Refresh: 0;url='index.php?page=35'");
}


    
?>