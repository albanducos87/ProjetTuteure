<div class="container font-weight-light pb-5">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <?php
    $pdo = new Mypdo();
    $personneManager = new PersonneManager($pdo);
    $idPersonne = $personneManager->getIdByLogin($_SESSION["login"]);
    if (empty($_POST["inputMail"])) {
        ?>
    <form  class="col col-md-7 m-auto shadow-lg p-3 mb-5 rounded " id="profil" action="index.php?page=23" method="post">
        <h1 class="font-weight-light">Mon profil</h1><br>

        <div class="col-12 m-auto">
            <div class="form-group row">
                <label class="text-left font-weight-bolder col-4 col-form-label ml-5">Mail :</label>
                <div class="col-6">
                    <input type="email" class="form-control" id="inputMail" name="inputMail"
                        <?php echo "value="."\"".$_SESSION["login"]."\"";?> required>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left font-weight-bolder col-4 col-form-label ml-5">Nom :</label>
                <div class="col-6">
                    <input type="text" class="form-control" id="inputNom" name="inputNom"
                        <?php echo "value="."\"".$personneManager->getNomByLogin($_SESSION["login"])."\"";?>required>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left font-weight-bolder col-4 col-form-label ml-5">Prénom :</label>
                <div class="col-6">
                    <input type="text" class="form-control" id="inputPrenom" name="inputPrenom"
                        <?php echo "value="."\"".$personneManager->getPrenomByLogin($_SESSION["login"])."\"";?>required>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left font-weight-bolder col-4 col-form-label ml-5">Téléphone :</label>
                <div class="col-6">
                    <input type="number" class="form-control" id="inputTel" name="inputTel"
                        <?php echo "value="."\"".$personneManager->getTelephoneByLogin($_SESSION["login"])."\"";?>required>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left font-weight-bolder col-4 col-form-label ml-5">Mot de passe :</label>
                <div class="col-6">
                    <input type="password" class="form-control" id="inputMdp" name="inputMdp">
                </div>
            </div>
            <input id="valider" type="submit" class="btn font-weight-light" value="Valider"> <input id="desinscrire" type="submit" class="btn font-weight-light"
                value="desinscrire">
        </div>
    </form>
    <?php } else {?>
    
    <?php
        if (! empty($personneManager->verifMail($_POST["inputMail"])) && ($_POST["inputMail"]) != $_SESSION["login"]) {
            ?>
    <h1>Ce mail est déjà utilisé</h1>
    <?php
            header("Refresh: 2;url='index.php?page=23'");
        }
         else {?>
         <h2>Votre profil a bien été modifié</h2>
   		 <p>Vous allez être redirigé</p>
   		 <?php 
            if (empty($_POST["inputMdp"])) {

                $personneManager->modifPersonne($idPersonne, $_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputTel"], $_POST["inputMail"]);
                $_SESSION["login"] = $_POST["inputMail"];
                if (isset($_SESSION["entreprise"])) {
                    header("Refresh: 2;url='index.php?page=10'");
                } else {
                    header("Refresh: 2;url='index.php?page=15'");
                }
            } else {
                // Ajouter grain de sel
                $personneManager->modifPersonneMdp($idPersonne, $_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputTel"], $_POST["inputMail"], $_POST["inputMdp"]);
                $_SESSION["login"] = $_POST["inputMail"];
                if (isset($_SESSION["entreprise"])) {
                    header("Refresh: 2;url='index.php?page=10'");
                } else {
                    header("Refresh: 2;url='index.php?page=15'");
                }
            }
        }
    }
    ?>
    <script type="text/javascript" src="./js/desinscrire.js"></script>
</div>