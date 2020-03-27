<?php
  $pdo=new Mypdo();
  $paysManager = new PaysManager($pdo);
  $villeManager = new VilleManager($pdo);
  $diplomeManager = new DiplomeManager($pdo);


  $villes = $villeManager->getAllVilles();
  $pays=$paysManager->getAllPays();
  $diplomes = $diplomeManager->getNomDiplomes();
if (empty($_POST["titre"])) {
?>
<div class="container font-weight-light pb-5" id="faireoffrestage">
    <form action="#" method="post" id="formulairefaireoffrestage" class="col-md-10 m-auto shadow-lg p-3 rounded">
      <h1 class="font-weight-light">Faire une offre de stage</h1><br>

      <div class="row">
          <div class="col-md-8 m-auto">
              <label>Titre du stage</label>
              <input name="titre" type="text" class="form-control" required>
          </div>
      </div><br>

      <div class="row">
        <div class="col-md-3 ml-auto">
            <select class="browser-default custom-select" name="villenom" required>
                <option value="null" hidden>Ville</option>
                  <?php
                  foreach ($villes as $ville){
                  ?>
                  <option value="<?php echo $ville->getId_ville();?>"><?php echo $ville->getNom_ville();?></option>
                  <?php
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <input name="debutStage" type="date" class="form-control" required ><br>
        </div>

        <div class="col-md-2 mr-auto">
            <select id="nbSemaine" name="nbSemaines" class="form-control">
                <option value="null" hidden>Durée-semaines</option>
                <?php for ($i=1; $i <= 52; $i++) { ?>
                    <option value=<?php echo $i ?>><?php echo $i; ?></option>
                <?php } ?>
                <option value="null"></option>
            </select>
        </div>
      </div>

      <div class="row">
          <div class="col-md-8 m-auto">
                <label>Missions</label>
                <textarea class="form-control" name="mission" aria-label="With textarea" rows="4" cols="50" required ></textarea>
          </div>
      </div><br>

      <div class="row">
        <div class="col-md-3 ml-auto">
            <label>Domaine de stage</label>
            <select class="browser-default custom-select" name="diplome" required>
                    <option value="null" hidden>Domaine</option>
                    <?php
                    foreach ($diplomes as $diplome){ ?>
                    <option value=<?php echo $diplome->getLib_Diplome()?>><?php echo $diplome->getLib_Diplome()?></option>
                    <?php }?>
            </select>
        </div>
        <div class="col-md-3 mr-auto">
            <label>Niveau</label>
            <select class="browser-default custom-select" name="niveau" required>
                    <option value="null" hidden>Niveau</option>
                    <option value="L">L</option>
                    <option value="M">M</option>
                    <option value="D">D</option>
            </select>
        </div>
      </div><br>

        <div class="row">
            <div class="col-md-8 m-auto">
                <label>Compétences recherchées</label>
                 <textarea name="description" class="form-control" aria-label="With textarea" rows="4" cols="50" required ></textarea>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-4 m-auto">
                <label>Langues</label>
                 <input name="langues" type="text" class="form-control" required>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-8 m-auto">
                <label>Autres critères</label>
                <textarea name="acriteres" class="form-control" aria-label="With textarea" rows="4" cols="50"></textarea>
            </div>
        </div><br>


        <div class="col m-auto ">
            <input type="submit" class="font-weight-light btn" name="envoyerNom" value="Poster l'offre"><br><br>
        </div>
  </form>
</div>
<?php
}else{
    $VilleManager = new VilleManager($pdo);
    $DiplomeManager = new DiplomeManager($pdo);
    $StageManager = new StageManager($pdo);
    $EntrepriseManager = new EntrepriseManager($pdo);
    $listeVille = $VilleManager->getAllVilles();
    $listeDiplome = $DiplomeManager->getAllDiplomes();
  $idEnt = $EntrepriseManager->getIdEntreprisebylogin($_SESSION["login"]);
  $idDiplome = $diplomeManager->getIdByDiplomeNiveau($_POST["niveau"],$_POST["diplome"]);
  if (!isset($_POST["acriteres"])){
      $_POST["acriteres"]=" ";
  }
  $idStage = $StageManager->getLastId() + 1;  
  $stage = new Stage(array('idStage'=>$idStage,
    'dateDebut'=>$_POST["debutStage"],
    'nbSemaines'=>$_POST["nbSemaines"],
    'mission'=>$_POST["mission"]." ".$_POST["acriteres"],
    'langueRequise'=>$_POST["langues"],
    'descriptionStage'=>$_POST["description"],
    'titre'=>$_POST["titre"],
    'hebergement'=>1,
    'idEntreprise'=>$idEnt,
    'idDiplome'=>$idDiplome,
    'idVille'=>$_POST["villenom"],
    'etat'=>0,
      'valide'=>0,
      'datePub'=> date('Y-m-d')));
    $StageManager->add($stage);
    ?>
    <div id="offreok" class="col-md-10 font-weight-light m-auto shadow-lg p-3 rounded ">
        <h3 class="font-weight-light">L'offre a bien été postée</h3><br>
        <h6 class="text-left font-weight-bold">Récapitulatif de l'offre :</h6><br>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-tasks"></i> <b class="font-weight-bold">Mission :</b> <?php echo $stage->getMission(); ?>
            </div>
            <div class="col-6" >
                <i class="fa fa-clock-o"></i> <b class="font-weight-bold">Durée :</b class="font-weight-bold"> <?php echo $stage->getNbSemaines(); ?> semaines a partir du <?php echo $stage->getDateDebut(); ?><br>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-suitcase"></i> <b class="font-weight-bold">Entreprise :</b> <?php echo $EntrepriseManager->getNomEntById($stage->getId_entreprise());?> à <?php echo $VilleManager->getVilleById($stage->getId_ville());?><br>
            </div>
            <div class="col-6">
                <i class="fa fa-tag"></i> <b class="font-weight-bold">Diplome requis :</b> <?php echo $DiplomeManager->getNomDiplomeById($stage->getId_diplome());?> niveau <?php echo $DiplomeManager->getNiveauDiplomeById($stage->getId_diplome());?><br>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-comments"></i> <b class="font-weight-bold">Langues requises : </b><?php echo $stage->getLangueRequise();?>
            </div>
        </div>
        <div class="row text-left m-auto">
            <div class="col-6">
                <i class="fa fa-pencil"></i> <b class="font-weight-bold"> Description :</b> <?php  echo $stage->getDescriptionStage() ?>.<br><br>
            </div>
        </div>
        <a href="index.php?page=12"> <input name="valider" type="submit" class="btn font-weight-light" value="Consulter mes offres"></a>
    </div>

<?php
    }
    ?>
