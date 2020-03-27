<h1> Supprimer CV </h1>
<?php 
$pdo = new Mypdo();
$Cvmanager = new CVManager($pdo);
$Cvdemanager = new CVDeManager($pdo);
if (!empty($_GET["idCV"])){
    $Cvdemanager->supprimerCVde($_GET["idCV"]);
    $Cvmanager->supprimerCV($_GET["idCV"]);
?>
    <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Le CV a été supprimé.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>
	<?php
    header("Refresh: 2;url='index.php?page=9'");
}?>
