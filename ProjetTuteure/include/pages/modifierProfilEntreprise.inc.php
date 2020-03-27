<?php
$pdo = new Mypdo();

$personneManager = new PersonneManager($pdo);
$entrepriseManager = new EntrepriseManager($pdo);
$villeManager = new VilleManager($pdo);
$idEntreprise = $entrepriseManager->getIdEntrepriseById($personneManager->getIdByLogin($_SESSION["login"]));


if (empty($_POST["inputMail"])) {
    $entreprise = $entrepriseManager->toObject($idEntreprise);
    ?>
<div class="container font-weight-light pb-5" >

	<form class="col col-md-8 m-auto shadow-lg p-3 mb-5 rounded " id="profil"
          action="index.php?page=27" method="post">
        <h1 class="font-weight-light">Mon entreprise</h1><br>

		<div class="col-10 m-auto"></div>
		<div class="form-group row">
			<label for="inputNom" class=" text-left col-4 col-form-label ml-5">Nom :</label>
			<div class="col-6">
				<input type="text" class="form-control" id="inputNom"
					name="inputNom"
					<?php echo "value=\"".$entreprise->getNom_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputMail" class=" text-left col-4 col-form-label ml-5">Mail :</label>
			<div class="col-6">
				<input type="email" class="form-control" id="inputMail"
					name="inputMail"
					<?php echo "value=\"".$entreprise->getMail_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputSiren" class=" text-left col-4 col-form-label ml-5">SIREN :</label>
			<div class="col-6">
				<input type="number" class="form-control" id="inputSiren"
					name="inputSiren"
					<?php echo "value=\"".$entreprise->getSiren_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputTel" class=" text-left col-4 col-form-label ml-5">Téléphone :</label>
			<div class="col-6">
				<input type="number" class="form-control" id="inputTel"
					name="inputTel"
					<?php echo "value=\"".$entreprise->getNum_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputAdr" class=" text-left col-3 col-form-label ml-5">Adresse :</label>
			<div class="col-8">
				<input type="text" class="form-control" id="inputAdresse"
					name="inputAdresse"
					<?php echo "value=\"".$entreprise->getAdr_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputCdp" class=" text-left col-4 col-form-label ml-5">Code postal :</label>
			<div class="col-3">
				<input type="number" class="form-control" id="inputCdp"
					name="inputCdp"
					<?php echo "value=\"".$entreprise->getCp_entreprise()."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="selectVille" class=" text-left col-4 col-form-label ml-5">Ville :</label>
			<div class="col-3">
				<select class="browser-default custom-select" name="selectVille">
				<?php $idVille = $entreprise->getId_ville()?>
					<option value=<?php echo $idVille ?>><?php echo $villeManager->getVilleByID($idVille)?></option>
						<?php
    $listeVilles = $villeManager->getListDesAutresVilles($idVille);
    foreach ($listeVilles as $ville) {
        ?>
						<option value=<?php echo $ville->getId_ville()?>><?php echo $ville->getNom_ville()?></option>
						<?php }?>
				</select>
			</div>
		</div>
		<input id="valider" type="submit" class="btn font-weight-light"
			value="Valider">

	</form>
</div>
<?php } else {?>
<?php $entrepriseManager->modifEntreprise($_POST["inputNom"],$_POST["inputMail"],$_POST["inputSiren"],$_POST["inputTel"],$_POST["inputAdresse"],$_POST["inputCdp"],$_POST["selectVille"],$idEntreprise)?>
    <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Les informations de votre entreprise ont bien été modifiées.</h5>
        </br>
        <h5 class="font-weight-light">Vous allez être rediriger.</h5>
    </div>
<?php
header("Refresh: 2;url='index.php?page=10'");
    
}
?>