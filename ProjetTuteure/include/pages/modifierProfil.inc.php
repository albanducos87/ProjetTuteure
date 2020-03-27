<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$etablissementManager = new EtablissementManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$Cvdemanager = new CVdeManager($pdo);
$idPersonne = $personneManager->getIdByLogin($_SESSION["login"]);
if (empty($_POST["etablissement"])) {
    ?>
<div class="container font-weight-light pb-5">

	<form class="col col-md-8 m-auto shadow-lg p-3 mb-5 rounded " id="profil" action="#"
		method="post">
        <h1 class="font-weight-light">Modifier profil</h1><br>
        <div class="col-12 m-auto">
            <div class="form-group row">
                <label class="col-2 col-form-label"">Mes Cv :</label>
            <?php

            $listeCV = $Cvdemanager->getListCvde($idPersonne);
            $countCv = 1;
            foreach ($listeCV as $cv) {
                ?>
                         <div class="col-2 pr-0">
                        <a class="btn btn-outline font-weight-light mr-2 " role="button" href=<?php echo '"index.php?page=20&idCV='.$cv->getId_cv().'"' ?>>CV <?php echo $countCv?></a>
                    </div>

                         <?php

                $countCv = $countCv + 1;
            } if($Cvdemanager->nbCV($idPersonne) < 3){ ?>
			<div class="col-3">
				<a class="btn btn-outline font-weight-light mr-2 " role="button" href="index.php?page=19">Ajouter un CV</a>
			</div>
			<?php } else { ?>
			    <div class="col-3">
				<p>Limite de CVs atteinte</p>
			</div>
			<?php }?>
		</div><br>
		<div class="form-group row">
			<label for="inputEtablissement" class="col-3 text-left col-form-label ml-5">Etablissement
				:</label>
			<div class="col-6">
				<select name="etablissement" class="browser-default custom-select">
				<?php $idEtablissement = $etudiantManager->getIdEtablissementByIdEtudiant($idPersonne)?>
					<option value=<?php echo $idEtablissement ?>><?php echo $etablissementManager->getNomEtablissementById($idEtablissement)?></option>
						<?php
    $listeEtablissements = $etablissementManager->getListDesAutresEtablissements($idEtablissement);
    foreach ($listeEtablissements as $etablissement) {
        ?>
						<option value=<?php echo $etablissement->getId_etablissement()?>><?php echo $etablissement->getNom_etablissement()?></option>
						<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputMail" class="col-3 text-left col-form-label ml-5">Mail :</label>
			<div class="col-6">
				<input type="email" class="form-control" id="inputMail"
					name="inputMail"
					<?php echo "value="."\"".$_SESSION["login"]."\"";?> required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputNom" class="col-3 text-left col-form-label ml-5">Nom :</label>
			<div class="col-6">
				<input type="text" class="form-control" id="inputNom"
					name="inputNom"
					<?php echo "value="."\"".$personneManager->getNomByLogin($_SESSION["login"])."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputPrenom" class="col-3 text-left col-form-label ml-5">Prénom :</label>
			<div class="col-6">
				<input type="text" class="form-control" id="inputPrenom"
					name="inputPrenom"
					<?php echo "value="."\"".$personneManager->getPrenomByLogin($_SESSION["login"])."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputTel" class="col-3 text-left col-form-label ml-5">Téléphone :</label>
			<div class="col-6">
				<input type="number" class="form-control" id="inputTel"
					name="inputTel"
					<?php echo "value="."\"".$personneManager->getTelephoneByLogin($_SESSION["login"])."\"";?>
					required>
			</div>
		</div>
		<div class="form-group row">
			<label for="inputTel" class="col-3 text-left col-form-label ml-5">Mot de passe :</label>
			<div class="col-6">
				<input type="password" class="form-control" id="inputMdp"
					name="inputMdp">
			</div>
		</div>
		<input id="valider" type="submit" class="btn font-weight-light "
			value="Valider"> <a id="desinscrire" class="btn font-weight-light">Se
			desinscrire</a>
	</form>
</div>
</div>
<?php } else {?>
<?php
    if (! empty($personneManager->verifMail($_POST["inputMail"])) && ($_POST["inputMail"]) != $_SESSION["login"]) {
        ?>
        <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
            <h5 class="font-weight-light">Ce mail est déjà utilisé.</h5>
        </div>
<?php
        header("Refresh: 2;url='index.php?page=8'");
    } else {
        if (empty($_POST["inputMdp"])) {
            ?>
            <div id="modif" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
                <h5 class="font-weight-light">Votre profil a bien été modifié.</h5>
                </br>
                <h5 class="font-weight-light">Vous allez être rediriger.</h5>
            </div>
<?php
            // Ajouter grain de sel
            $personneManager->modifPersonne($idPersonne, $_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputTel"], $_POST["inputMail"]);
            $etudiantManager->modifEtudiant($idPersonne, $_POST["etablissement"]);
            $_SESSION["login"] = $_POST["inputMail"];
            header("Refresh: 2;url='index.php?page=0'");
        } else {
            $personneManager->modifPersonneMdp($idPersonne, $_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputTel"], $_POST["inputMail"], $_POST["inputMdp"]);
            $etudiantManager->modifEtudiant($idPersonne, $_POST["etablissement"]);
            $_SESSION["login"] = $_POST["inputMail"];
            header("Refresh: 2;url='index.php?page=0'");
        }
    }
}

?>
<script type="text/javascript" src="./js/desinscrire.js"></script>
