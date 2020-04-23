<?php

session_start();
include_once('./fonctions/bd.php');
include_once('./fonctions/utilisateur.php');

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
$pseudo = $_SESSION['pseudo'];

if(isset($_POST['Deconnecter'])) {
	setDisconnected($pseudo, $link);
	session_unset();
	header('Location: index.php?subscribe=no');
}

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Une nouvelle variante de Pinterest produite par des étudiants !" />
        <meta name="author" content="BONIS Alexis p1805132" />
        <title>MemePlanet</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">MemePlanet</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#galerie">Galerie</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#apropos">A propos</a></li>
                        <?php
                            $pseudo = $_SESSION['pseudo'];
                            echo "<p>Connecté avec le compte : $pseudo</p>";
                        ?>
                        <form action ="index-connected.php" method="post">
                            <button name="Deconnecter" class="btn btn-primary btn">Se Déconnecter</button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image--><img class="masthead-avatar mb-5" src="assets/img/logoM.png" alt="" /><!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">MemePlanet</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <div class="masthead-subheading font-weight-light mb-0">La nouvelle application pour partager vos memes et voir ceux de vos amis ou du monde entier !</div>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="galerie">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Galerie</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <form action ="ajouter.php" method="post">
			        <button name="ajouter" class="btn btn-outline-primary">ajouter une photo</button>
		        </form>
				<label>Selectionnez la catégorie :</label>
                <form action="index-connected.php#galerie" method="POST">
                    <SELECT id="categorie" name="categorie" required>
                        <OPTION name="Tout"> Tout</OPTION>
                        <?php
                            require_once("fonctions/requetesql.php");
                            $link = getConnection("localhost", "root", "", "ProjetBDW");
                            RecupImageCategorie($link);
                            closeConnexion($link);
                        ?>
				    </SELECT>
                    <input type="submit" name="Valider" value="OK" />
                </form>
            </div>
            <div class = "img-container">
                <?php
                    AfficherImageCategorie($_POST['categorie'], $link);
                    closeConnexion($link);
                ?>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="apropos">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">A propos</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ml-auto"><div class="lead">MemePlanet est une plateforme gratuite pour consulter les photos mises en ligne par vos amis, ou même le monde entier ! Vous pouvez également créer un compte ou vous connecter pour mettre vos propres photos !</div></div>
                    <div class="col-lg-4 mr-auto"><div class="lead">A vous de voir quelles photo mettre ! Que ce soit une photo de votre chien, ou d'un paysage, MemePlanet accepte tout ! Mais ce qu'on préfère ici... Ce sont les memes !</div></div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">23 Avenue Pierre de Coubertin<br />69100 Villeurbanne</p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Sur les réseaux</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-facebook-f"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-twitter"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">A propos de MemePlanet</h4>
                        <p class="lead mb-0">MemePlanet est gratuit, pour le projet de BDW1 2019/2020 uniquement.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <section class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright © MemePlanet 2020</small></div>
        </section>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>
    </body>
</html>
