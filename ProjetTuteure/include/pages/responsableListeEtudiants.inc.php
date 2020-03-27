<h1 class="font-weight-light">Mes étudiants</h1><br>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$demandeManager = new DemandeManager($pdo);
$responsableEtudiantManager = new ResponsableEtudiantManager($pdo);
$listeMesEtudiants = $etudiantManager->getListeMesEtudiants($responsableEtudiantManager->getIdEtablissementById($personneManager->getIdByLogin($_SESSION["login"])));
if(empty($listeMesEtudiants)){
    ?>
    <div id="aucunEtudiant" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
        <h5 class="font-weight-light"> Vous n'avez aucun étudiant.</h5>
    </div><?php
}else {
    ?>
<div class="container pb-5">
    <table class="col-8 m-auto table border border-dark">
        <thead class="text-white">
        <tr id="tetetabbleu">
            <th class="text-center font-weight-light ">Etudiant</th>
            <th class="text-center font-weight-light">Etat du stage</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($listeMesEtudiants as $etudiant) {
            $idEtudiant = $etudiant->getId_etudiant();
            ?>
            <tr class="table-secondary">
            	<td>
            		<a href="<?php echo "index.php?page=9&idEtudiant=".$idEtudiant?>"><?php echo $personneManager->getPrenomById($idEtudiant) . " ";
                    echo $personneManager->getNomById($idEtudiant); ?></a>
                  </td> 
            <?php if (!empty($demandeManager->etudiantAUnStageEnCours($idEtudiant))) { ?>
                <td class="text-center"><img src="image/iconecheck.png" style="width: 35px;"></td>
            <?php } else { ?>
                <td class="text-center"><img src="image/iconewrong.png" style="width: 40px;"></td>
            <?php }
        }
        ?>
        </tr>
        </tbody>
    </table>
</div>
    <?php
}
?>
