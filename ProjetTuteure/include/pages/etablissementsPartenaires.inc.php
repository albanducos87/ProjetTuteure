<?php
$pdo=new Mypdo();
$entrepriseManager = new EntrepriseManager($pdo);
$listeEntreprises = $entrepriseManager->getListEntreprises();


?>

<div class="container p-3 ">
    <h1 class="font-weight-light">Entreprises partenaires</h1><br>
    <table class="col-8 m-auto table border border-dark" >
        <thead class="text-white">
        <tr id="tetetabbleu">
            <th class="text-center font-weight-light ">Entreprises partenaires</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($listeEntreprises as $entreprise){
            ?>
            <tr class="table-secondary">
            <th scope="text-center font-weight-light row"><?php echo $entreprise->getNom_entreprise(); ?></th>
                <?php
        }
        ?>
        </tbody>
    </table>
</div>
