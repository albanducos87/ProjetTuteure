<?php
$pdo = new Mypdo();
$masquerEtudiant = new MasquerEtudiantManager($pdo);

$idEtudiants = array();
for ($i = 0; $i <$_GET["nbEtudiant"]; $i++){
    $idEtudiants[] = $_GET["idEtudiant".$i];
}
foreach ($idEtudiants as $etudiant){
    $masquerEtudiant->masquerEtu($etudiant);
}
?>
<?php if ($_GET["nbEtudiant"] > 0) { ?>
    <div id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les étudiants séléctionnés sont validés.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>
    <?php
}
else{
    header("Refresh: 0;url='index.php?page=35'");
}
header("Refresh: 2;url='index.php?page=35'");
?>