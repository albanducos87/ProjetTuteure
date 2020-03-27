
<?php
	$pdo = new Mypdo();
	$personneManager = new PersonneManager($pdo);
	$nomPostulant = $personneManager->getNomByLogin($_SESSION["login"]);
	$prenomPostulant = $personneManager->getPrenomByLogin($_SESSION["login"]);
	$telPostulant = $personneManager->getTelephoneByLogin($_SESSION["login"]);
	$naissancePostulant = $personneManager->getNaissanceByLogin($_SESSION["login"]);
	$idPersonne = $personneManager->getIdByLogin($_SESSION["login"]);
	$demandeManager = new DemandeManager($pdo);
	$cvDeManager = new CVdeManager($pdo);

if (empty($_POST["cvNum"])){
?>
<div class="container font-weight-light pb-5">



    <div  class="col col-md-6 m-auto shadow-lg p-3 mb-5 rounded " id="postuler">
        <h1 class="font-weight-light">Postuler </h1>

        <form action="#" class="col-10" method="post">
            <div class="form-group row">
                <label class="col-5 col-form-label"><b>Selectionnez un CV</b></label>
                <div class="col-7">
                    <?php
                    $listeCV = $cvDeManager->getListCvde($idPersonne);
                    $countCV = 1;
                    ?>
                    <select class="form-control col" name="cvNum">
                        <option hidden>CV</option>
                        <?php
                        $i = 1;
                        foreach ($listeCV as $cv) {

                            ?>		<option value="<?php echo $cv->getId_cv();?>"><?php echo "CV".$i ?></option>
                            <?php
                            $i = $i+1;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label"><b>Nom :</b></label>
                <div class="col-7">
                    <?php echo $nomPostulant ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label"><b>Prénom :</b></label>
                <div class="col-7">
                    <?php echo $prenomPostulant?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label"><b>Téléphone :</b></label>
                <div class="col-7">
                    <?php echo $telPostulant?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label"><b>Date de naissance :</b></label>
                <div class="col-7">
                    <?php echo $naissancePostulant ?>
                </div>
            </div>
            <?php
            print_r($_SESSION["login"]);
            if(!empty($_SESSION["login"])){
                ?>
            <input type="submit" id="postuler" class="btn btn-primary" value="Postuler">
            <?php
            }
            ?>


        </form>
    </div>

<?php 
} else {
?>
	<h2 class="font-weight-light">Votre candidature a été envoyée</h2>
	<p class="font-weight-light">Redirection dans 2 secondes</p>
<?php
	$demandeManager->postuler($idPersonne, $_GET["idStage"], $_POST["cvNum"]);
	header("Refresh: 2;url='index.php?page=0'");
	

}
?>
</div>
