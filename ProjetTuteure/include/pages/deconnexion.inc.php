<?php session_destroy();
header("Refresh:2, URL=index.php?page=0");
?>
<div id="deconnexionok" class="col-md-8 ml-auto mr-auto mt-3 shadow-lg p-3 mb-5 rounded" >
    <h5 class="font-weight-light">Vous avez bien été déconnecté.</h5>
    </br>
    <h5 class="font-weight-light">Redirection automatique dans 2 secondes.</h5>
</div>
   <?php

?>
