<?php
$pdo = new Mypdo();
$stageManager = new StageManager($pdo);

$idOffres = array();
for ($i = 0; $i <$_GET["nbStage"]; $i++){
    $num_stage = $i;
    $idOffres[] = $_GET["idStage".$i];
}
foreach ($idOffres as $offre){
    $stageManager->validerOffre($offre);
}
?>
<?php if ($_GET["nbStage"] > 0) { ?>
    <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les propositons séléctionnées sont désormais publiques.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>

    <?php
}
else{
    header("Refresh: 0;url='index.php?page=16'");
}
header("Refresh: 2;url='index.php?page=16'");
?>