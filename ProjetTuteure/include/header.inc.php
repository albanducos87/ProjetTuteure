<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">

</head>
<?php session_start();


?>

	<body>

	<div id="header">

        <?php

        if(!empty($_SESSION["login"])){
            if (isset($_SESSION["entreprise"])){?>
                <nav class="navbar navbar-expand-sm fixed-top">
                    <a class="nav-link navbar-brand" href="index.php?page=10">
                    <img class="img-responsive"src="image/logoUnilim.png" style="width:175px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:white; font-size:28px;"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white font-weight-light" href="index.php?page=10" >Faire une offre de stage</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white font-weight-light" href="index.php?page=11" >Demandes reçues</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white font-weight-light" href="index.php?page=12" >Nos offres</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto ">
                            <li>
                                <a class="nav-link dropdown-toggle text-white font-weight-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Mon Entreprise
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="index.php?page=25">Consulter Profil</a>
                                    <a class="dropdown-item" href="index.php?page=23">Modifier Profil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?page=26">Consulter Profil Entreprise</a>
                                    <a class="dropdown-item" href="index.php?page=27">Modifier Profil Entreprise</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?page=7">Deconnexion</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            <?php
            }else{
                if (isset($_SESSION["etudiant"])){?>
                    <nav class="navbar navbar-expand-sm fixed-top">
                        <a class="nav-link navbar-brand" href="index.php?page=0">
                        <img class="img-responsive"src="image/logoUnilim.png" style="width:175px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:white; font-size:28px;"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-white font-weight-light" href="index.php?page=0" >Rechercher un stage</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white font-weight-light" href="index.php?page=13" >Stages en cours</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white font-weight-light" href="index.php?page=14" >Mes demandes</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto">
                                <li>
                                    <a class="nav-link dropdown-toggle text-white font-weight-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Mon Profil
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="index.php?page=9">Consulter profil</a>
                                        <a class="dropdown-item" href="index.php?page=8">Modifier Profil</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?page=7">Deconnexion</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                <?php
                }else{
                    if (isset($_SESSION["responsable"])){?>
                        <nav class="navbar navbar-expand-sm fixed-top">
                            <a class="nav-link navbar-brand" href="index.php?page=15">
                            <img class="img-responsive"src="image/logoUnilim.png" style="width:175px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:white; font-size:28px;"></i></span>
                            </button>
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=15" >Suivi des étudiants</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=16" >Propositions des entreprise</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=17" >Demandes des étudiants</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=18" >Mes étudiants</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <li>
                                        <a class="nav-link dropdown-toggle text-white font-weight-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         Mon profil
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="index.php?page=24">Consulter profil</a>
                                            <a class="dropdown-item" href="index.php?page=23">Modifier Profil</a>
                                            <?php if ($_SESSION["admin"] != 0){?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="index.php?page=35">Vérifier Etudiant</a>
                                                <a class="dropdown-item" href="index.php?page=36">Vérifier Entreprise</a>
                                                <a class="dropdown-item" href="index.php?page=41">Etudiants Vérifiés</a>
                                                <a class="dropdown-item" href="index.php?page=42">Entreprises Vérifiées</a>
                                                <?php 
                                            }?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="index.php?page=7">Deconnexion</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                <?php
                    }else{?>
                        <nav class="navbar navbar-expand-sm fixed-top">
                            <a class="nav-link navbar-brand" href="index.php?page=0">
                            <img class="img-responsive"src="image/logoUnilim.png" style="width:175px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:white; font-size:28px;"></i></span>
                            </button>
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=0" >Rechercher un stage</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=1" >Entreprises partenaires</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-light" href="index.php?page=6" >Connexion</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    <?php
                    }
                }
            }
        }else{?>
            <nav class="navbar navbar-expand-sm fixed-top">
                <a class="nav-link navbar-brand" href="index.php?page=0">
                <img class="img-responsive"src="image/logoUnilim.png" style="width:175px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:white; font-size:28px;"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-light" href="index.php?page=0" >Rechercher un stage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-light" href="index.php?page=1" >Etablissements partenaires</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-light" href="index.php?page=6" >Connexion</a>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php
        }
        ?>
    </div>
</body>
</html>
