
    <h1 class="font-weight-light">Demandes des étudiants</h1><br>
<?php
$pdo=new Mypdo();
$PersonneManager = new PersonneManager($pdo);
$VilleManager = new VilleManager($pdo);
$DiplomeManager = new DiplomeManager($pdo);
$StageManager = new StageManager($pdo);
$EntrepriseManager = new EntrepriseManager($pdo);
$demandeManager = new DemandeManager($pdo);
$idResponsable = $PersonneManager->getIdByLogin($_SESSION["login"]);
$ResponsableEtudiantManager = new ResponsableEtudiantManager($pdo);
$listeDemande = $demandeManager->getAllDemandesByIdEtablissement($ResponsableEtudiantManager->getIdEtablissementById($idResponsable));

if(null != $listeDemande){
?>
    <div class="container pb-5">
<table class="table border border-dark" >
      <thead class="text-white">
      <tr id="tetetabbleu">
        <th class=" text-center font-weight-light">Etudiant</th>
        <th class=" text-center font-weight-light">Libellé du stage</th>
        <th class=" text-center font-weight-light">Durée</th>
        <th class=" text-center font-weight-light">Entreprise</th>
        <th class=" text-center font-weight-light">Lieu</th>
        <th class=" text-center font-weight-light">Accepté</th>
      </tr>
      </thead>

<?php
foreach($listeDemande as $demande){
?>

        <tr class="table-secondary">
          <th scope="row"><?php echo $PersonneManager->getNomById($demande->getId_etudiant()), " ", $PersonneManager->getPrenomById($demande->getId_etudiant()) ?></th>
          <td class=" text-center font-weight-light"><?php echo $StageManager->getTitreById($demande->getId_stage())?></td>
          <td class=" text-center font-weight-light"><?php echo $StageManager->getDureeById($demande->getId_stage())?> semaines</td>
          <td class=" text-center font-weight-light"><?php echo $EntrepriseManager->getNomEntById($StageManager->getIdEntrepriseById($demande->getId_stage()))?></td>
          <td class=" text-center font-weight-light"><?php echo $StageManager->getVilleById($demande->getId_stage())?></td>
          <td class=" text-center font-weight-light"><?php
            if($demande->getAccepte() == 1){
                ?>
                <img src="image/iconecheck.png" style="width: 35px;">
                <?php
            }else{
                ?>
                <img src="image/interrogation.png" style="width: 35px;">
                <?php
            }
            ?>
          </td>
        </tr>


<?php
}
?>
</tbody>
</table>
    </div>
<?php
}else{
?>
    <div id="aucunEtudiant" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
        <h5 class="font-weight-light">Aucune demande en cours.</h5>
    </div>
<?php
}
?>

