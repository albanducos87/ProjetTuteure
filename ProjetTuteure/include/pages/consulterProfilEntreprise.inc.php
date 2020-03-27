<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$entrepriseManager = new EntrepriseManager($pdo);
$villeManager = new VilleManager($pdo);
if (!empty($_GET["idEntreprise"])){
    $entreprise = $entrepriseManager->toObject($_GET["idEntreprise"]);
    ?>
<div class="container font-weight-light pb-5">
    <div  class="col col-md-10 m-auto shadow-lg p-3 mb-5 rounded " id="profil"><br>
    <h1 class="font-weight-light">Entreprise <?php echo $entreprise->getNom_entreprise()?></h1><br>
    <?php 
}
if (empty($_GET["idEntreprise"])){
    $idEntreprise = $entrepriseManager->getIdEntrepriseById($personneManager->getIdByLogin($_SESSION["login"]));
    $entreprise = $entrepriseManager->toObject($idEntreprise);
    ?>
    <div class="container font-weight-light pb-5">
        <div  class="col col-md-10 m-auto shadow-lg p-3 mb-5 rounded " id="profil"><br>
    <h1 class="font-weight-light">Mon entreprise</h1><br>
    <?php 
}


    ?>

	<div class="col-10  m-auto">
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder ">Nom de l'entreprise :</label>
			<div class="text-left col-6">
				<?php echo $entreprise->getNom_entreprise() ?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder ">Mail de l'entreprise</label>
			<div class="text-left col-6">
				<?php echo $entreprise->getMail_entreprise()?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder ">Numéro SIREN</label>
			<div class="text-left col-6">
				<?php echo $entreprise->getSiren_entreprise()?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder  ">Téléphone de l'entreprise : </label>
			<div class="text-left col-6">
				<?php echo $entreprise->getNum_entreprise()?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder">Adresse de l'entreprise : </label>
			<div class="text-left col-6">
				<?php echo $entreprise->getAdr_entreprise()?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder">Code postal :</label>
			<div class="text-left col-6">
				<?php echo $entreprise->getCp_entreprise()?>
			</div>
		</div>
		<div class="form-group row">
			<label class="text-left col-6 font-weight-bolder ">Ville :</label>
			<div class="text-left col-6">
				<?php echo $villeManager->getVilleByID($entreprise->getId_ville())?>
			</div>
		</div>
        <input id="valider" type="reset" class="btn font-weight-light" value="Retour" onclick="history.go(-1)">
	</div>
</div>
