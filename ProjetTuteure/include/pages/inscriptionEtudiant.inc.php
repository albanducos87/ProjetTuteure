<div class="container font-weight-light pb-5">
	<?php
		$pdo = new Mypdo();
		$personneManager = new PersonneManager($pdo);
		$etablissementManager = new EtablissementManager($pdo);
		$etudiantManager = new EtudiantManager($pdo);


		if (empty($_POST["valider"])){
	?>


		<form id="formulaireinscriptiontout" class="col col-md-10 m-auto shadow-lg p-3 mb-5 rounded" action="index.php?page=3" method="post">
            <h1 class="font-weight-light">Inscription</h1>
		<div class="form-group row">
			<label for="inputEtablissement" class="col-5 col-form-label">Etablissement :</label>
			<div class="col-4">
				<select class="form-control" name="etablissement">
						<?php
    		$listeEtablissements = $etablissementManager->getListEtablissements();
    		foreach ($listeEtablissements as $etablissement) {
        ?>
						<option value=<?php echo $etablissement->getId_etablissement()?>><?php echo $etablissement->getNom_etablissement()?></option>
						<?php }?>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputMail" class="col-5 col-form-label">Mail :</label>
			<div class="col-4">
				<input type="email" class="form-control" id="inputMail" name="inputMail" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputNom" class="col-5 col-form-label">Nom :</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputNom" name="inputNom" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputPrenom" class="col-5 col-form-label">Prénom :</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputPrenom" name="inputPrenom" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputTel" class="col-5 col-form-label">Téléphone :</label>
			<div class="col-4">
				<input type="tel" class="form-control" id="inputTel" name="inputTel" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputDate" class="col-5 col-form-label">Date de naissance :</label>
			<div class="col-4">
				<input type="date" class="form-control" id="inputDate" name="inputDate" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputTel" class="col-5 col-form-label">Mot de passe :</label>
			<div class="col-4">
				<input type="password" class="form-control" id="inputMdp" name="inputMdp" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputTel" class="col-5 col-form-label">Confirmer mot de passe :</label>
			<div class="col-4">
				<input type="password" class="form-control" id="inputMdp" name="inputMdp2" required>
			</div>
		</div>
            <input name="valider" type="submit" class="btn font-weight-light" value="Valider">
	</form>

	<?php
		}else{
			if($_POST["inputMdp"] != $_POST["inputMdp2"]){
				echo "Mot de passe non confirmé !";
				header("Refresh:3; URL=index.php?page=3");			
			}else{
				$verifMail = $personneManager->verifMail($_POST["inputMail"]);
				if($verifMail == true){
					echo "Adresse mail déjà utilisée !";
					header("Refresh:3; URL=index.php?page=3");	
				}else{
					$personneManager->inscriptionEtu($_POST["inputNom"],$_POST["inputPrenom"],$_POST["inputTel"],$_POST["inputMail"],$_POST["inputMdp"],$_POST["inputDate"]);

					$idEtudiant = $personneManager->getIdByLogin($_POST["inputMail"]);
					

					$etudiantManager->insertEtu($idEtudiant,$_POST["etablissement"]);

					echo "Vous avez été enregistré avec succès !";
					header("Refresh:2; URL=index.php?page=6");
				}
			}
		}
			?>

</div>