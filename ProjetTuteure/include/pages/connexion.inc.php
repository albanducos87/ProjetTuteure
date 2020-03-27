<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
$personne = new Personne($_POST);
if (empty($_POST["envoyerNom"])){
?>
<div class="container font-weight-light pb-5">
    <form id="formulaireconnexion" class="col col-md-4 m-auto shadow-lg p-3 mb-5 rounded" action="#" method="post">
        <h1 class="font-weight-light">Connexion</h1>
        <div>
            <label>Adresse e-mail</label>
            <input name="login" id="clogin" type="email" class="form-control" placeholder="Entrez l'email" required><br>
        </div>
        <div>
            <label>Mot de passe</label>
            <input name="password" id="cpwd" type="password" class="form-control" placeholder="Entrez le mot de passe" required><br>
        </div>
        <input type="submit" class="btn font-weight-light" name="envoyerNom" value="Se connecter"><br><br>
        <a class="text-primary" href="index.php?page=2">Pas inscrit? Inscrivez-vous?<a/>
    </form>
</div>

    
<?php
  }else{
    if(!empty($_POST["envoyerNom"])){
    //$personneLog=$_POST["login"];
    $mdp = $_POST["password"];
    //$salt ="48@!alsd";
    //$pwd_crypte=sha1(sha1($mdp).$salt);
    $testPersonne = $personneManager->testPersonne($_POST["login"]);
    
    if ($testPersonne == 0){
        ?>
        <div id="connexionfail" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
            <h5 class="font-weight-light">Login ou mot de passe invalide !</h5>
            <?php
            header("Refresh:2; URL=index.php?page=6");?>
        </div>
        <?php

    } 
    else {
      
      $testPersonneLogin = $personneManager->testPersonneLog($_POST["login"]);
      foreach ($testPersonneLogin as $personne) {
        $mdpPersonne = $personne->getMdp_personne();
      }
       

      //if ($pwd_crypte == $mdpPersonne){
      if($mdp == $mdpPersonne){
        $_SESSION["personne"]=serialize($personne);
        ?>
        <div id="connexionok" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
        <h5 class="font-weight-light">Vous avez bien été connecté</h5>
        </br>
            <?php

         $testPersonneEtudiant = $personneManager->testPersonneEtudiant($_POST["login"]);
         $testPersonneEntreprise = $personneManager->testPersonneEntreprise($_POST["login"]);
         $testPersonneResponsable = $personneManager->testPersonneResponsable($_POST["login"]);
         if ($testPersonneEtudiant != 0){
             ?>
             <h5 class="font-weight-light">Redirection automatique dans 2 secondes.</h5>
             <?php
            header("Refresh:2, URL=index.php?page=0");
            $_SESSION["etudiant"] = $testPersonneEtudiant;
            $_SESSION["login"]=$_POST["login"];
          }else{
            if($testPersonneEntreprise != 0){
                ?>
                <h5 class="font-weight-light">Redirection automatique dans 2 secondes.</h5><?php
              header("Refresh:2, URL=index.php?page=10");
              $_SESSION["entreprise"] = $testPersonneEntreprise;
              $_SESSION["login"]=$_POST["login"];
            }else{
              if($testPersonneResponsable != 0){
                  ?>
                  <h5 class="font-weight-light">Redirection automatique dans 2 secondes.</h5><?php
                header("Refresh:2, URL=index.php?page=15");
                $_SESSION["admin"] = $personneManager->testAdmin($_POST["login"]);
                $_SESSION["responsable"] = $testPersonneResponsable;
                $_SESSION["login"]=$_POST["login"];
              }
            }
            ?>
             </div>
             <?php
          }
        }else {?>
          <div id="connexionfail" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
              <h5 class="font-weight-light">Login ou mot de passe invalide !</h5>
              <?php
          header("Refresh:2; URL=index.php?page=6");
          ?>
          </div>
<?php
        }

      

      
    }
  }
}
  
?>
