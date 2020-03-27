<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<h1 class="font-weight-light">Propositions des entreprises</h1>
<br>
<?php
$pdo = new Mypdo();
$managerEntreprise = new EntrepriseManager($pdo);
$managerDiplome = new DiplomeManager($pdo);
$managerResponsableEtudiant = new ResponsableEtudiantManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerStage= new StageManager($pdo);
$managerEtablissement = new EtablissementManager($pdo);
$idResponsable = $managerPersonne->getIdByLogin($_SESSION["login"]);
$etablissementResponsable = $managerResponsableEtudiant->getIdEtablissementById($idResponsable);
$villeResponsable = $managerEtablissement->getIdVilleByIdEtablissement($etablissementResponsable);
$offresStages = $managerStage->getStagesNonOccupesByVille($villeResponsable);
if (!empty($offresStages)){
?>
<div id="proprecues" class="container pb-5">
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
            <td><a id="valider" href="index.php?page=29" class="font-weight-light btn ">Valider</a>
            <td>
                <button class="font-weight-light btn ">Signaler</button>
            </td>
        </tr>
        <tr id="tetetabbleu">
            <th></th>
            <th class="font-weight-light">Entreprise</th>
            <th class="font-weight-light">Libellé du stage</th>
            <th class="font-weight-light">Période</th>
            <th class="font-weight-light">Lieu</th>
            <th class="font-weight-light">Niveau</th>
            <th class="font-weight-light">Détails</th>
        </tr>
        </thead>

        <tbody>
        <?php $i = 0;
        foreach ($offresStages as $stage) {
            ?>
            <tr class="table-secondary">
                <td><input <?php echo "name=" . $stage->getId_stage() ?> type="checkbox"></td>
                <td class="font-weight-light"><?php echo $managerEntreprise->getNomEntById($stage->getId_entreprise()) ?></td>
                <td class="font-weight-light"><?php echo $stage->getTitre() ?></td>
                <td class="font-weight-light"><?php echo $stage->getDateDebut() ?></td>
                <td class="font-weight-light"><?php echo $managerEntreprise->getAdresseEntById($stage->getId_entreprise()) ?></td>
                <td class="font-weight-light"><?php echo $managerDiplome->getNiveauDiplomeById($stage->getId_diplome()) ?></td>
                <td class="font-weight-light"><a href="index.php?page=22&amp;idStage=<?php echo $stage->getId_stage() ?>"><img
                                src="./image/iconedetail.png"></a></td>
            </tr>
            <?php
            $i = $i + 1;
        } ?>
      </tbody>
	</table>
</div>
<?php }else
{?>
<div id="aucunReponsable" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
    <h5 class="font-weight-light"> Il n'y a aucune nouvelle offre dans votre secteur </h5>
</div><?php
}
?>
<script type="text/javascript" src="./js/propositionsRecues.js"></script>
