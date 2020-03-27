<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$etablissementManager = new EtablissementManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$Cvdemanager = new CVdeManager($pdo);

if (empty($_GET["idEtudiant"])){
    $idPersonne = $personneManager->getIdByLogin($_SESSION["login"]);
    $login = $_SESSION["login"];
    ?>
<div class="container font-weight-light pb-5">
    <div  class="col col-md-6 m-auto shadow-lg p-3 mb-5 rounded " id="profil">
    <h1 class="font-weight-light">Mon profil</h1><br>
    <?php 
}
if (!empty($_GET["idEtudiant"])){
    $idPersonne = $_GET["idEtudiant"];
    $login = $personneManager->getMailById($idPersonne);
    ?>
        <div class="container font-weight-light pb-5">
                <div  class="col col-md-6 m-auto shadow-lg p-3 mb-5 rounded " id="profil"><br>
    <h1 class="font-weight-light">Profil de <?php echo $personneManager->getNomById($idPersonne)." ".$personneManager->getPrenomById($idPersonne)?></h1>
    <?php 
}
?>

        <div class="col-md-10 m-auto">
            <div class="form-group row">
            <label class="text-left col-4 col-form-label">Mes Cv :</label>
            <?php    $listeCV = $Cvdemanager->getListCvde($idPersonne);
                     $countCv = 1;
                     foreach ($listeCV as $cv){?>
                     <div class="col-3">
                        <a class="btn btn-outline font-weight-light mr-2 " role="button" href=<?php echo '"index.php?page=34&idCV='.$cv->getId_cv().'"' ?>>CV <?php echo $countCv?></a>
                     </div>
                     <?php $countCv = $countCv +1;
                     }
                ?>
                </div>
            <div class="form-group row">
                <label class="text-left col-4 col-form-label">Etablissement
                    :</label>
                <div class="col-7">
                    <?php $idEtablissement = $etudiantManager->getIdEtablissementByIdEtudiant($idPersonne)?>
                        <?php echo $etablissementManager->getNomEtablissementById($idEtablissement)?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 col-form-label">Mail :</label>
                <div class="col-7">
                    <?php echo $login;?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 col-form-label">Nom :</label>
                <div class="col-7">
                    <?php echo $personneManager->getNomByLogin($login);?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 col-form-label">Prénom :</label>
                <div class="col-7">
                    <?php echo $personneManager->getPrenomByLogin($login)?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 col-form-label">Téléphone :</label>
                <div class="col-7">
                    <?php echo $personneManager->getTelephoneByLogin($login)?>
                </div>
            </div>
            <input id="valider" type="reset" class="btn font-weight-light" value="Retour" onclick="history.go(-1)">
        </div>
    </div>
</div>
