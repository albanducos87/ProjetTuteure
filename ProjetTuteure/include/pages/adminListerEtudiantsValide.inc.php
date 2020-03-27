<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<h1 class="font-weight-light" >Liste des étudiants validés</h1>
<br>
<?php
$pdo = new Mypdo();
$managerEtudiant = new EtudiantManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerResponsableEtudiant = new ResponsableEtudiantManager($pdo);
$idEtablissement = $managerResponsableEtudiant->getIdEtablissementById($managerPersonne->getIdByLogin($_SESSION["login"]));
$listeEtudiants = $managerEtudiant->getListeMesEtudiantsMasques($idEtablissement);

if (!empty($listeEtudiants)){
?>
<div id="validerEtudiants" class="container pb-5">
    <table class="table border border-dark ">
        <thead class="text-white">
        <tr class="table-secondary text-primary small">
            <td>
                <button id="selectAll" class="font-weight-light btn">Tout sélectionner</button>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <button id="supprimer" class="font-weight-light btn">Supprimer</button>
            </td>
            <td></td>
        </tr>
        <tr id="tetetabbleu">
            <th></th>
            <th class=" text-center font-weight-light">Nom</th>
            <th class=" text-center font-weight-light">Prénom</th>
            <th class=" text-center font-weight-light">Adresse mail</th>
            <th class=" text-center font-weight-light">Telephone</th>
            <th class=" text-center font-weight-light">Date de naissance</th>
            <th class=" text-center font-weight-light">Profil</th>
        </tr>
        </thead>

        <tbody>
        <?php 
        foreach ($listeEtudiants as $etudiant) {
            $idEtu = $etudiant->getId_etudiant();
            ?>
            <tr class="table-secondary">
                <td class=" text-center font-weight-light"><input <?php echo "name=" . $etudiant->getId_etudiant() ?> type="checkbox"></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getNomById($idEtu) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getPrenomById($idEtu) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getMailById($idEtu) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getTelephoneById($idEtu) ?></td>
                <td class="font-weight-light"><?php echo $managerPersonne->getNaissanceById($idEtu) ?></td>
                <td class="text-center font-weight-light"><a href="index.php?page=9&idEtudiant=<?php echo $idEtu ?>"><img
                                src="./image/iconedetail.png"></a></td>
            </tr>
            <?php
            
        } ?>
      </tbody>
	</table>
</div>
<?php }else
{?>
<div id="aucunEtudiant" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
    <h5 class="font-weight-light"> Il n'y a aucun étudiant inscrit validé dans votre établissement.</h5>
</div>
<?php
}
?>
<script type="text/javascript" src="./js/listerEtudiantValide.js"></script>
