<div class="container font-weight-light pb-5">
    <?php
    $pdo = new Mypdo();
    $personneManager = new PersonneManager($pdo);
    ?>
    <div  class="col col-md-6 m-auto shadow-lg p-3 mb-5 rounded " id="profil">
        <h1 class="font-weight-light">Mon profil</h1><br>

        <div class="col-md-10 m-auto">
            <div class="form-group row">
                <label class="text-left col-4 font-weight-bolder ml-5 ">Mail :</label>
                <div class="text-left col-5">
                    <?php echo $_SESSION["login"];?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 font-weight-bolder ml-5">Nom :</label>
                <div class="text-left col-5">
                    <?php echo $personneManager->getNomByLogin($_SESSION["login"]);?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 font-weight-bolder ml-5">Prénom :</label>
                <div class="text-left col-5">
                    <?php echo $personneManager->getPrenomByLogin($_SESSION["login"])?>
                </div>
            </div>
            <div class="form-group row">
                <label class="text-left col-4 font-weight-bolder ml-5">Téléphone :</label>
                <div class="col-5 text-left">
                    <?php echo $personneManager->getTelephoneByLogin($_SESSION["login"])?>
                </div>
            </div>
            <input type="button" class="btn font-weight-light" value="Retour" onClick="document.location.href = document.referrer" />

        </div>
    </div>
</div>
