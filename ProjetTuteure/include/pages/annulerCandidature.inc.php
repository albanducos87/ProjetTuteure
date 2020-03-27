<?php
$pdo = new Mypdo();
$demandeManager = new DemandeManager($pdo);
$personneManager = new PersonneManager($pdo);
$idStage = $_GET["idStage"];
$demandeManager->deleteDemandeByIdStageIdEtudiant($idStage,$personneManager->getIdByLogin($_SESSION["login"]));
header("Refresh: 2;url='index.php?page=14'");
?>

<h1>Votre canditature a été annulée</h1>