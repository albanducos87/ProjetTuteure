
<?php
$pdo = new Mypdo();
$Cvmanager = new CVManager($pdo);
$diplomeManager = new DiplomeManager($pdo);
if (! empty($_GET["idCV"])) {
    if (empty($_POST["inputLangue"])) {
        $cv = $Cvmanager->getCVById($_GET["idCV"]);
        $idDiplome = $cv->getId_diplome();
        $diplome = $diplomeManager->getDiplomeById($idDiplome);

        ?>
        <div class="container font-weight-light pb-5">

	<form id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" action="index.php?page=9"
		method="post">
        <h1 class="font-weight-light" >Consulter CV</h1><br>
        <div class="col-10  m-auto">
		<div class="form-group row">
			<label for="inputLangue" class="text-left col-4 font-weight-bolder ">Langues :</label>
			<div class="col-6">
				<p> <?php echo $cv->getLangue() ?></p>
			</div>
		</div>
		<div class="form-group row">
			<label for="selectNiveau" class="text-left col-4 font-weight-bolder ">Niveau Diplome
				:</label>
			<div class="col-2">
				<p><?php echo $diplome->getNiveau_diplome()?></p>
			</div>
			<label for="selectDiplome" class="text-left col-4 font-weight-bolder ">Domaine :</label>
			<div class="col-2">
				<p><?php echo $diplome->getLib_diplome()?></p>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputDescription" class="text-left col-4 font-weight-bolder ">Description
				:</label>
			<div class="col-6">
				<p><?php echo $cv->getDescription() ?></p>
			</div>
		</div>
				<input id="retour" type="reset" class="btn font-weight-light"
					value="Retour" onclick="history.go(-1)">
			</div>
        </div>
	</form>
</div>
<?php
    }
} else {
    ?>
    <div id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Vous n'avez pas sélectionné de CV.</h5>

    </div>

<?php
}
?>