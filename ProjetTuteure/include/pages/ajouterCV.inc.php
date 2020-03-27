<h1>Ajouter un CV</h1>
<?php $pdo=new Mypdo();?>
<?php if (empty($_POST["niveau"])){?>
<form id="ajouterCV" method="post" action="index.php?page=19">
	<div class="row">
		<div class="form-group col-6">
			<label for="inputEmail4">Niveau d'études</label> <select
				name="niveau" id="niveau">
				<option value="L">L</option>
				<option value="M">M</option>
				<option value="D">D</option>
			</select>
		</div>
		<div class="form-group col-6">
			<label for="domaine">Domaine</label> <select name="domaine"
				id="domaine">
		<?php 
		$diplomeManager = new DiplomeManager($pdo);
		$listeDomaines = $diplomeManager->getNomDiplomes();
		
		foreach ($listeDomaines as $domaine){?>
		    <option <?php echo "value=\"".$domaine->getLib_diplome()."\""?>><?php echo $domaine->getLib_diplome() ?>
		    </option>
		    <?php 
		}
		?>
			</select>
		</div>
		<div class="form-group col-12">
			<label for="exampleFormControlTextarea1">Langues parlées</label>
			<textarea class="form-control" id="exampleFormControlTextarea1"
				rows="1" name="langue" required></textarea>
		</div>
		<div class="form-group col-12">
			<label for="exampleFormControlTextarea1">Brève description de vous</label>
			<textarea class="form-control" id="exampleFormControlTextarea1"
				rows="3" name="description" required></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ajouter le CV</button>
</form>
<?php
} else {
    $cvManager = new CVManager($pdo);
    $cvdeManager = new CVdeManager($pdo);
    $personneManager = new PersonneManager($pdo);
    $diplomeManager = new DiplomeManager($pdo);
    $cvManager->ajouterCV($_POST["langue"],$diplomeManager->getIdByDiplomeNiveau($_POST["niveau"], $_POST["domaine"]),$_POST["description"]);
    $cvdeManager->ajouterCvDe($personneManager->getIdByLogin($_SESSION["login"]));
    ?>
<h2>Votre CV a bien été ajouté</h2>
<p>Vous allez être redirigé</p>
<?php
    header("Refresh: 2;url='index.php?page=9'");
}
?>