<div class="container font-weight-light pb-5">
	<?php
		$pdo = new Mypdo();
		$personneManager = new PersonneManager($pdo);
		$etablissementManager = new EtablissementManager($pdo);
		$entrepriseManager = new EntrepriseManager($pdo);
		$villeManager = new VilleManager($pdo);

		if (empty($_POST["continuer"])){
	?>


		<form id="formulaireinscriptiontout" class="col col-md-10 m-auto shadow-lg p-3 mb-5 rounded" action="index.php?page=5" method="post">
        <h1 class="font-weight-light">Inscription</h1>

		<div class="form-group row">
			<label for="inputMail" class="col-5 col-form-label">Mail :</label>
			<div class="col-4">
				<input type="email" class="form-control" id="inputMail" name="inputMail" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputNom" class="col-5 col-form-label">Nom de l'entreprise:</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputNom" name="inputNom" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputSiren" class="col-5 col-form-label">Numéro Siren :</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputPrenom" name="inputSiren" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputTel" class="col-5 col-form-label">Téléphone :</label>
			<div class="col-4">
				<input type="tel" class="form-control" id="inputTel" name="inputTel" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputAdr" class="col-5 col-form-label">Adresse :</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputDate" name="inputAdr" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputCdp" class="col-5 col-form-label">Code Postal :</label>
			<div class="col-4">
				<input type="text" class="form-control" id="inputMdp" name="inputCdp" required>
			</div>
		</div>

        <div class="form-group row">
            <label for="inputVille" class="col-5 col-form-label"> Ville :</label>
            <div class="col-4">
                <select class="form-control" name="inputVille">
                    <?php
                    $listeVilles = $villeManager->getListDesVilles($idVille);
                    foreach ($listeVilles as $ville) {
                        ?>						<option value =<?php echo $ville->getNom_ville()?>><?php echo $ville->getNom_ville()?></option>
                        <?php
                    }
                    ?>
                    </option>
                </select>
            </div>
        </div>



		
		
		<input name="continuer" type="submit" class="btn font-weight-light" value="Continuer">
		

	</form>

	<?php
		}else{
				$ville = $villeManager->getIdByVille($_POST["inputVille"]);
				$verifMail = $entrepriseManager->verifMailEnt($_POST["inputMail"]);
				if($verifMail == true){
					echo "Adresse mail déjà utilisée !";
					header("Refresh:3; URL=index.php?page=5");	
				}else{

					$entrepriseManager->inscriptionEnt($_POST["inputNom"],$_POST["inputAdr"],$_POST["inputTel"],$_POST["inputMail"],$_POST["inputSiren"],$_POST["inputCdp"],$ville);

					$_SESSION["idEntreprise"] = $entrepriseManager->getIdEntrepriseByNom($_POST["inputNom"]);

					
					header("Refresh:2; URL=index.php?page=28");
				}
			}
	?>
</div>