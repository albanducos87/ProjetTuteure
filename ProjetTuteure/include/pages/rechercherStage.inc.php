
<div class="container font-weight-light pb-5" id="recherchestage">

<?php
$pdo=new Mypdo();
$VilleManager = new VilleManager($pdo);
$DiplomeManager = new DiplomeManager($pdo);
$StageManager = new StageManager($pdo);
$EntrepriseManager = new EntrepriseManager($pdo);
$listeVille = $VilleManager->getAllVilles();
$listeNomDiplome = $DiplomeManager->getAllNomDiplomes();



    if(empty($_POST['nbSemaine']) && empty($_POST['titre']) && empty($_POST['diplome']) && empty($_POST['ville'])){
    ?>
    <form id="formulairerecherchestage" class="col-12 align-items-center justify-content-center m-auto shadow-lg p-3 mb-5 rounded" action="#" method="POST">
        <div class="row align-items-center justify-content-center"><h1 class="font-weight-light">Recherche de stage</h1></div>
        <div class="row">
            <div class="col-md-4 pt-3">
                <input type="text" name="recherche" class="form-control col4" placeholder="Mots clés">
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="nbSemaine">
                        <option value="null" hidden>Durée-semaines</option>
                        <?php for ($i=1; $i <= 20; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="diplome">
                        <option value="null" hidden>Diplome</option>

                        <?php 
                        $nb = sizeof($listeNomDiplome);
                        
                        for($i = 0 ; $i < $nb; $i++){
                            foreach ($listeNomDiplome[$i] as $nomDip) {
                                 ?>
                            <option value="<?php  echo $nomDip; ?>"><?php  echo $nomDip; ?></option>
                            
                        <?php 
                            }
                        } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="niveau">
                        <option value="null" hidden>Niveau</option>
                       <option value="L">L</option>
                       <option value="M">M</option>
                       <option value="D">D</option>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="ville">
                        <option value="null" hidden>Ville</option>
                        <?php foreach ($listeVille as $ville) { ?>
                            <option value="<?php echo $ville->getId_ville();?>"><?php echo $ville->getNom_ville(); ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                <input name="valider" type="submit" class="btn font-weight-light" value="Rechercher">
            </div>
        </div>
    </form>

    <?php 

    }else { ?>
    <form id="formulairerecherchestage" class="col-12 align-items-center justify-content-center m-auto shadow-lg p-3 mb-5 rounded" action="#" method="POST">
        <div class="row align-items-center justify-content-center"><h1 class="font-weight-light">Recherche de stage</h1></div>
        <div class="row">
            <div class="col-md-4 pt-3">
                <input type="text" name="recherche" class="form-control col4" placeholder="Mots clés">
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="nbSemaine">
                        <option value="null" hidden>Durée-semaines</option>
                        <?php for ($i=1; $i <= 20; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="diplome">
                        <option value="null" hidden>Diplome</option>

                        <?php 
                        $nb = sizeof($listeNomDiplome);
                        
                        for($i = 0 ; $i < $nb; $i++){
                            foreach ($listeNomDiplome[$i] as $nomDip) {
                                 ?>
                            <option value="<?php  echo $nomDip; ?>"><?php  echo $nomDip; ?></option>
                            
                        <?php 
                            }
                        } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="niveau">
                        <option value="null" hidden>Niveau</option>
                       <option value="L">L</option>
                       <option value="M">M</option>
                       <option value="D">D</option>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                    <select class="form-control col1" name="ville">
                        <option value="null" hidden>Ville</option>
                        <?php foreach ($listeVille as $ville) { ?>
                            <option value="<?php echo $ville->getId_ville();?>"><?php echo $ville->getNom_ville(); ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-md-2 pt-3">
                <input name="valider" type="submit" class="btn font-weight-light" value="Rechercher">
            </div>
        </div>
    </form>


    <?php
    $idDiplome = $DiplomeManager->getIdByDiplomeNiveau($_POST['niveau'],$_POST['diplome']);
    $listeStage = $StageManager->getStageBySearch($_POST['recherche'],$_POST['nbSemaine'],$_POST['ville'],$idDiplome);
    ?>
    <div id="resultatstage" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded">
        <?php
        if (empty($listeStage)) {
            echo "Aucun resultat";
        }else{
            if (!empty($listeStage)) {
                foreach ($listeStage as $stage) {
                ?>
                        <div class="col-10 m-auto ">
                            <h4 class="font-weight-light"><?php echo $stage->getTitre(); ?></h4>
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-calendar"></i><?php echo " ".$stage->getNbSemaines(). " semaines";?>
                                </div>
                                <div class="col">
                                    <i class="fa fa-suitcase"></i><?php echo " ".$EntrepriseManager->getNomEntById($stage->getId_entreprise());?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-tasks"></i> <?php echo " ".$stage->getMission(); ?>
                                </div>
                                <div class="col">
                                    <a href="index.php?page=22&amp;idStage=<?php echo $stage->getId_stage() ; ?>">Voir plus  <i class="fa fa-plus-circle"></i></a>
                                </div>
                            </div>

                        </div>
                    <hr class="style1">
                    <?php
                }
            }
        }
        ?>
    </div>
    <?php } ?>
</div>