
<?php 
	$pdo = new Mypdo();
	$stageManager = new StageManager($pdo);
	$personneManager = new PersonneManager($pdo);
	$entrepriseManager = new EntrepriseManager($pdo);
	$villeManager = new VilleManager($pdo);
	$diplomeManager = new DiplomeManager($pdo);
	$responsableCo = $_SESSION["login"];
	$idResponsableCo = $personneManager->getIdByLogin($responsableCo);
	$responsableManager = new ResponsableEntrepriseManager($pdo);
	$nombreOffres = $stageManager->nombreOffresById($idResponsableCo);
	$offres = $stageManager->getListOffresById($idResponsableCo);
	$nomEntreprise = $entrepriseManager->getNomEntById($idResponsableCo);
	
if(empty($_GET["num"])){
	if($nombreOffres == 0){
	    ?>

<div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
            <h5 class="font-weight-light">Vous n'avez posté aucune offre.</h5>
        </div>
        <?php
	}else{
?>
        <h1 class="font-weight-light">Offres créées</h1>
		<br>
		<table class="table border border-dark">
			<thead class="text-white">
				<tr id="tetetabbleu">
					<th class="font-weight-light text-center">Numéro</th>
					<th class="font-weight-light text-center">Stage</th>
					<th class="font-weight-light text-center">Description</th>
					<th class="font-weight-light text-center">Mission</th>
					<th class="font-weight-light text-center">Durée</th>
				</tr>
			</thead>
<?php 
			foreach ($offres as $offre) {
				$numOffre = $offre->getId_Stage();
?>
				<tr class="table-secondary font-weight-light">
					<th class="text-center"><a href="index.php?page=12&num=<?php echo $num = $numOffre?>"><?php echo $numOffre;?></a></th>
					<td><?php echo $offre->getTitre();?></td>
					<td><?php echo $offre->getDescriptionStage();?></td>
					<td><?php echo $offre->getMission();?></td>
					<td class="'text-center"><?php echo $offre->getNbSemaines();?></td>
				</tr>
<?php
			}
?>
		</table>

        <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
            <h6 class="font-weight-light">Cliquez sur le numéro pour modifier l'offre.</h6>
        </div>
<?php 
	}
}else{
	if(empty($_POST["inputTitre"])){
		$idDiplome = $stageManager->getDiplomeById($_GET["num"]);
		$libDiplome = $diplomeManager->getNomDiplomeById($idDiplome);
		$libVille = $villeManager->getVilleByIdStage($_GET["num"]);
		$idVille = $villeManager->getIdVilleByIdStage($_GET["num"]);


	
?>
        <h1 class="font-weight-light">Modifier offre</h1><br>
        <div class="container font-weight-light pb-5" id="faireoffrestage">
            <form action="#" method="post" id="formulairefaireoffrestage" class="col-md-10 m-auto shadow-lg p-3 rounded">
                <h2 class="font-weight-light">Modification de l'offre n°<?php echo $_GET["num"];?> de l'entreprise <?php echo $nomEntreprise?> </h2><br>

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <label>Titre du stage</label>
                        <input type="text" name="inputTitre" class="form-control"<?php echo 'value="'.$stageManager->getTitreById($_GET["num"]).'"'?> required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-3 ml-auto">
                        <select name="ville" class="browser-default custom-select">
                            <option value=<?php echo $libVille?>><?php echo $libVille ?></option>
                            <?php
                            $listeVilles = $villeManager->getListDesAutresVilles($idVille);
                            foreach ($listeVilles as $ville) {
                                ?>						<option value = <?php echo $ville->getNom_ville()?>><?php echo $ville->getNom_ville()?></option>
                                <?php
                            }
                            ?>
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3  ">
                        <select id="nbSemaine" name="nbSemaines" class="form-control">
                            <option value=<?php echo $stageManager->getDureeById($_GET["num"])?>><?php echo $stageManager->getDureeById($_GET["num"])?></option>
                            <?php for ($i=1; $i <= 52; $i++) { ?>
                                <option value=<?php echo $i ?>><?php echo $i; ?></option>
                            <?php } ?>
                            <option value="null"></option>
                        </select>
                    </div>
                    <div class="col-md-2 mr-auto ">
                        <select name="diplome" class="browser-default custom-select">
                            <option value=<?php echo $libDiplome?>><?php echo $libDiplome ?></option>
                            <?php
                            $listeDiplomes = $diplomeManager->getListDesAutresDiplomes($idDiplome);
                            foreach ($listeDiplomes as $diplome) {
                                ?>						<option value = <?php echo $diplome->getLib_Diplome()?>><?php echo $diplome->getLib_Diplome()?></option>
                                <?php
                            }
                            ?>
                            </option>
                        </select>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <label>Missions</label>
                    <textarea name="inputMission" class="form-control" rows="4" cols="50"  required><?php echo $stageManager->getMissionById($_GET["num"])?> </textarea>

                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-8 m-auto">
                        <label>Description</label>
                        <textarea type="text" name="inputDescription" class="form-control" rows="4" cols="50" required> <?php echo $stageManager->getDescriptionById($_GET["num"])?>
                        </textarea>
                    </div>
                </div><br>


                <div class="row">
                    <div class="col-md-4 m-auto">
                        <input type="text" class="form-control" name="inputLangue" <?php echo 'value="'.$stageManager->getLangueById($_GET["num"]).'"'?> required>
                    </div>
                </div><br>



                <div class="col m-auto ">
                    <input type="submit" class="font-weight-light btn" name="envoyerNom" value="Mettre a jour l'offre"><br><br>
                </div>
            </form>
        </div>

        <?php
	}else{
		echo "<h2>Votre offre a été modifiée</h2>";
		echo "<p>Redirection dans 2 secondes</p>";
		$idDiplome = $diplomeManager->getIdByLib($_POST["diplome"]);
		$idVille = $villeManager->getIdByVille($_POST["ville"]);
		
		$stageManager->updateStage($_GET["num"], $_POST["inputMission"], $_POST["inputLangue"], $_POST["inputDescription"], $_POST["inputTitre"], $idDiplome, $idVille, $_POST["nbSemaines"]);
		
		header("Refresh:2; URL=index.php?page=10");
	}
		

}
	
?>