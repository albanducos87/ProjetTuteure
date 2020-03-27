<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<h1 class="font-weight-light">Valider les responsables entreprises</h1>
<br>
<?php
$pdo = new Mypdo();
$managerRespEnt = new ResponsableEntrepriseManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$listeResponsables = $managerRespEnt->getListeResponsableEntrepriseNonMasques();
$entrepriseManager = new EntrepriseManager($pdo);

if (!empty($listeResponsables)){
?>
<div id="validerEntrprise" class="container pb-5">
    <table class="table border border-dark ">
        <thead class="text-white">
        <tr class="table-secondary text-primary small">
            <td>
                <button id="selectAll" class="font-weight-light btn ">Tout sélectionner</button>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a id="valider" href="index.php?page=37" class="font-weight-light btn ">Valider</a>
            <td>
                <button class="font-weight-light btn " id="supprimer">Supprimer</button>
            </td>
        </tr>
        <tr id="tetetabbleu">
            <th class="text-center font-weight-light"></th>
            <th class="text-center font-weight-light">Nom</th>
            <th class="text-center font-weight-light">Prénom</th>
            <th class="text-center font-weight-light">Adresse mail</th>
            <th class="text-center font-weight-light">Telephone</th>
            <th class="text-center font-weight-light">Date de naissance</th>
            <th class="text-center font-weight-light">Entreprise</th>
        </tr>
        </thead>

        <tbody>
        <?php 
        foreach ($listeResponsables as $resp) {
            $idResp = $resp->getId_responsable_entreprise();
            ?>
            <tr class="table-secondary">
                <td class="text-center font-weight-light"><input <?php echo "name=" . $idResp ?> type="checkbox"></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getNomById($idResp) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getPrenomById($idResp) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getMailById($idResp) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getTelephoneById($idResp) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getNaissanceById($idResp) ?></td>
                <td class="text-center font-weight-light"><a href="index.php?page=26&idEntreprise=<?php echo $entrepriseManager->getIdEntrepriseById($idResp); ?>"><img
                                src="./image/iconedetail.png"></a></td>
            </tr>
            <?php
            
        } ?>
      </tbody>
	</table>
</div>
<?php }else
{?>
    <div id="aucunReponsable" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
<h5 class="font-weight-light"> Il n'y a aucun nouveau responsable d'entreprise </h5>
    </div>
<?php
}
?>
<script type="text/javascript" src="./js/listerResponsableEntreprise.js"></script>
