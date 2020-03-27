<div id="texte">
<?php
if (!empty($_GET["page"])){
  $page=$_GET["page"];}
  else
  {$page=0;
  }
switch ($page) {
//accueil personne non inscrite
case 0:
  include_once('pages/rechercherStage.inc.php');//Page d'accueil générale du site + recherche de stage
  break;

case 1:
  include_once('pages/etablissementsPartenaires.inc.php');
  break;

//inscription
case 2:
  include_once("pages/inscription.inc.php");//inscription générale
    break;
case 3:
  include_once("pages/inscriptionEtudiant.inc.php");//inscription en tant qu'étudiant
    break;
case 4:
   include_once("pages/inscriptionResponsable.inc.php");//inscription en tant que responsable
   break;
case 5:
    include_once("pages/inscriptionEntreprise.inc.php");//inscription en tant qu'entreprise
    break;
case 28:
    include_once("pages/inscriptionEntrepriseDeux.inc.php");//inscription en tant qu'entreprise
    break;

//connexion
case 6:
    include_once("pages/connexion.inc.php");
    break;
case 7:
    include_once("pages/deconnexion.inc.php");
    break;

//Mon profil
case 8:
    include_once('pages/modifierProfil.inc.php');
    break;
case 9:
    include_once('pages/consulterProfil.inc.php');
    break;


//Entreprise
case 10:
    include_once('pages/entrepriseFaireOffreStage.inc.php');//faire une offre de stage + accueil entreprise
    break;
case 11:
    include_once('pages/entrepriseDemandesRecues.inc.php');//liste des demandes reçues par l'entreprise
    break;
case 12:
    include_once('pages/entrepriseListeOffres.inc.php');//liste des offres crées par l'entreprise
    break;
//Etudiant
case 13:
    include_once('pages/etudiantStageEnCours.inc.php');
    break;
case 14:
    include_once('pages/etudiantMesDemandes.inc.php');
    break;


//Responsable
case 15:
    include_once('pages/responsableStagesSuivis.inc.php');
    break;
case 16:
    include_once("pages/responsablePropositionsRecues.inc.php");
    break;
case 17:
    include_once("pages/responsableDemandeEtudiants.inc.php");
    break;
case 18:
    include_once("pages/responsableListeEtudiants.inc.php");
     break;
//CV
case 19:
    include_once("pages/ajouterCV.inc.php");
    break;
case 20:
    include_once("pages/modifierCV.inc.php");
    break;
case 21:
    include_once("pages/supprimerCV.inc.php");
    break;
//
case 22:
    include_once("pages/detailStage.inc.php");
    break;
case 23:
    include_once("pages/modifierProfilResponsableEtudiant.inc.php"); // Fonctionne aussi pour entreprise
    break;
case 24:
    include_once("pages/consulterProfilResponsableEtudiant.inc.php"); 
    break;
case 25:
    include_once("pages/consulterProfilResponsableEntreprise.inc.php"); 
    break;
case 26:
    include_once("pages/consulterProfilEntreprise.inc.php"); 
    break;
case 27:
    include_once("pages/modifierProfilEntreprise.inc.php");
    break;
case 29:
    include_once("pages/validerOffres.inc.php");
    break;





    case 31:
        include_once("pages/desincription.inc.php");
        break;
    case 32:
        include_once("pages/annulerCandidature.inc.php");
        break;
case 33:
    include_once("pages/postuler.inc.php");
    break;
case 34:
    include_once("pages/consulterCV.inc.php");
    break;
case 35:
    include_once("pages/adminListerEtudiant.inc.php");
    break;
case 36:
    include_once("pages/adminListerResponsableEntreprise.inc.php");
    break;
case 37:
    include_once("pages/adminMasquerEtudiant.inc.php");
    break;
case 38:
    include_once("pages/supprimerComptesEtudiant.inc.php");
    break;
case 39:
    include_once("pages/adminMasquerRespEnt.inc.php");
    break;
case 40:
    include_once("pages/supprimerComptesRespEnt.inc.php");
    break;
case 41:
    include_once("pages/adminListerEtudiantsValide.inc.php");
    break;
case 42:
    include_once("pages/adminListerResponsablesEntreprisesValide.inc.php");
    break;











    default : 	include_once('pages/rechercherStage.inc.php');
}

?>
</div>
