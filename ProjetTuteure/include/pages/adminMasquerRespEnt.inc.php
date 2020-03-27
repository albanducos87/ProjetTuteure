<?php
$pdo = new Mypdo();
$masquerResponsableEntrepriseManager = new MasquerResponsableEntrepriseManager($pdo);

$idRespEnt = array();
for ($i = 0; $i <$_GET["nbRespEnt"]; $i++){
    $idRespEnt[] = $_GET["idRespEnt".$i];
}
foreach ($idRespEnt as $respEnt){
    $masquerResponsableEntrepriseManager->masquerResponsableEnt($respEnt);
}
?>
<?php if ($_GET["nbRespEnt"] > 0) { ?>
    <div id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les entreprises séléctionnés sont validés.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>

    <?php
}
else{
    header("Refresh: 0;url='index.php?page=36'");
}
header("Refresh: 2;url='index.php?page=36'");
?>