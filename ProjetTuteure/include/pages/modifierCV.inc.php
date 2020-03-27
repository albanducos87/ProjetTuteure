
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
            <form id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" action=<?php echo '"index.php?page=20&idCV='.$_GET["idCV"].'"'?>"
                  method="post">
	<h1 class="font-weight-light">Modifier CV</h1>
     <div class="col-12  m-auto">
		<div class="form-group row">
			<label for="inputLangue" class="col-2 col-form-label">Langues :</label>
			<div class="col-4">
				<input type="text" class="form-control" name="inputLangue"
					<?php echo 'value="'.$cv->getLangue().'"' ?> required>
			</div>
		</div>
		<div class="form-group row">
			<label for="selectNiveau" class="col-3 col-form-label">Niveau Diplome
				:</label>
			<div class="col-2">
				<select name="niveau" class="browser-default custom-select">
					<option value="L">L</option>
					<option value="M">M</option>
					<option value="D">D</option>
				</select>
			</div>
			<label for="selectDiplome" class="col-2 col-form-label">Domaine :</label>
			<div class="col-4">
				<select name="domaine" class="browser-default custom-select">
					<option value=<?php echo $diplome->getLib_diplome() ?>><?php echo $diplome->getLib_diplome()?></option>
						<?php
        $listeDiplomes = $diplomeManager->getListDesAutresDiplomesDistinct($diplome->getLib_diplome());
        foreach ($listeDiplomes as $diplome) {
            ?>
						<option value=<?php echo $diplome->getLib_Diplome()?>><?php echo $diplome->getLib_Diplome()?></option>
						<?php }?>
			</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputDescription" class="col-3 col-form-label">Description
				:</label>
			<div class="col-8">
				<textarea class="form-control" name="inputDescription" rows="3"
					required><?php echo $cv->getDescription() ?> </textarea>
			</div>
		</div>
				<input id="valider" type="submit" class="font-weight-light btn"
					value="Valider">
				<a class="btn font-weight-light" href=<?php echo '"index.php?page=21&idCV='.$_GET["idCV"].'"'?>>Supprimer
					le CV</a>

	</form>
</div>
<?php } else {?>
<div id="cv" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Votre CV a bien été modifié.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être redirigé</h5>
    </div>
<?php
        $Cvmanager->updateCV($_GET["idCV"], $_POST["inputLangue"], $_POST["niveau"], $_POST["domaine"], $_POST["inputDescription"]);
        header("Refresh: 2;url='index.php?page=9'");
    }
} else {
    ?>
<h1>Vous n'avez pas selectionné de CV</h1>

<?php
}
?>